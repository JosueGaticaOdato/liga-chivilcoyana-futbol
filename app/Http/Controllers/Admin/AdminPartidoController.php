<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\PartidoRequest;
use App\Models\Equipo;
use App\Models\Estadio;
use App\Models\Fase;
use App\Models\Partido;
use App\Models\Torneo;
use App\Models\Zona;
use App\Services\TablaService;
use Illuminate\Http\Request;

class AdminPartidoController
{
    public function __construct(protected TablaService $tablaService)
    {
    }

    public function index(Request $request)
    {
        $query = Partido::with([
            'torneo.temporada',
            'torneo.categoria',
            'local.club',
            'visitante.club',
            'estadio',
            'fase',
            'zona'
        ]);

        if ($request->filled('torneo_id')) {
            $query->where('torneo_id', $request->torneo_id);
        }

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        if ($request->filled('jornada')) {
            $query->where('jornada', $request->jornada);
        }

        if ($request->filled('fecha')) {
            $query->whereDate('fecha_hora', $request->fecha);
        }

        $partidos = $query->orderByDesc('fecha_hora')->orderByDesc('id')->paginate(15)->withQueryString();
        $torneos = Torneo::with(['temporada', 'categoria'])->orderByDesc('id')->get();

        return view('admin.partidos.index', compact('partidos', 'torneos'));
    }

    public function create(Request $request)
    {
        $torneos = Torneo::with(['fases.zonas', 'categoria', 'temporada'])->orderByDesc('id')->get();
        $estadios = Estadio::orderBy('nombre')->get();

        $selectedTorneoId = $request->query('torneo_id', $torneos->first()?->id);
        $selectedTorneo = $torneos->firstWhere('id', $selectedTorneoId);

        $fases = $selectedTorneo ? $selectedTorneo->fases : collect();
        $zonas = $fases->first() ? $fases->first()->zonas : collect();

        // Obtener IDs de las zonas del torneo seleccionado
        $zonaIds = $selectedTorneo
            ? $selectedTorneo->fases->flatMap->zonas->pluck('id')->toArray()
            : [];

        // Traer únicamente los equipos que participan en las zonas de este torneo
        $equipos = Equipo::with('club', 'categoria')
            ->where('activo', true)
            ->whereHas('equiposTorneos', function ($query) use ($zonaIds) {
                $query->whereIn('zona_id', $zonaIds);
            })
            ->orderBy('nombre')
            ->get();

        // Fallback a los equipos de la categoría si el torneo aún no tiene equipos en equipo_competicion
        if ($equipos->isEmpty() && $selectedTorneo) {
            $equipos = Equipo::with('club', 'categoria')
                ->where('activo', true)
                ->where('categoria_id', $selectedTorneo->categoria_id)
                ->orderBy('nombre')
                ->get();
        }

        return view('admin.partidos.create', compact(
            'torneos',
            'estadios',
            'equipos',
            'selectedTorneoId',
            'fases',
            'zonas'
        ));
    }

    public function store(PartidoRequest $request)
    {
        $data = $request->validated();

        // Si no se eligió estadio, heredar el estadio del club local
        if (empty($data['estadio_id'])) {
            $equipoLocal = Equipo::with('club')->find($data['equipo_local_id']);
            $data['estadio_id'] = $equipoLocal?->club?->estadio_id;
        }

        $partido = Partido::create($data);

        // Recalcular tabla de posiciones si el partido está finalizado
        if ($partido->estado === 'finalizado' && $partido->fase) {
            $this->tablaService->recalcular($partido->fase);
        }

        return redirect()->route('admin.partidos.index', ['torneo_id' => $partido->torneo_id])
            ->with('success', 'Partido registrado exitosamente.');
    }

    public function edit(Partido $partido)
    {
        $torneos = Torneo::with(['fases.zonas', 'categoria', 'temporada'])->orderByDesc('id')->get();
        $estadios = Estadio::orderBy('nombre')->get();

        $partido->load(['torneo.fases.zonas', 'local.club', 'visitante.club']);
        $fases = $partido->torneo ? $partido->torneo->fases : collect();
        $zonas = $partido->fase ? $partido->fase->zonas : ($fases->first() ? $fases->first()->zonas : collect());

        $zonaIds = $partido->torneo
            ? $partido->torneo->fases->flatMap->zonas->pluck('id')->toArray()
            : [];

        // Traer únicamente los equipos que participan en el torneo
        $equipos = Equipo::with('club', 'categoria')
            ->where('activo', true)
            ->where(function ($query) use ($zonaIds, $partido) {
                $query->whereHas('equiposTorneos', function ($q) use ($zonaIds) {
                    $q->whereIn('zona_id', $zonaIds);
                })
                ->orWhereIn('id', [$partido->equipo_local_id, $partido->equipo_visitante_id]);
            })
            ->orderBy('nombre')
            ->get();

        if ($equipos->isEmpty() && $partido->torneo) {
            $equipos = Equipo::with('club', 'categoria')
                ->where('activo', true)
                ->where('categoria_id', $partido->torneo->categoria_id)
                ->orderBy('nombre')
                ->get();
        }

        return view('admin.partidos.edit', compact(
            'partido',
            'torneos',
            'estadios',
            'equipos',
            'fases',
            'zonas'
        ));
    }

    public function update(PartidoRequest $request, Partido $partido)
    {
        $data = $request->validated();

        // Si no se eligió estadio, heredar el estadio del club local
        if (empty($data['estadio_id'])) {
            $equipoLocal = Equipo::with('club')->find($data['equipo_local_id']);
            $data['estadio_id'] = $equipoLocal?->club?->estadio_id;
        }

        $estadoAnterior = $partido->estado;
        $faseAnterior = $partido->fase;

        $partido->update($data);

        // Recalcular tabla si el estado es finalizado o si antes lo estaba
        if ($partido->fase && ($partido->estado === 'finalizado' || $estadoAnterior === 'finalizado')) {
            $this->tablaService->recalcular($partido->fase);
            if ($faseAnterior && $faseAnterior->id !== $partido->fase_id) {
                $this->tablaService->recalcular($faseAnterior);
            }
        }

        return redirect()->route('admin.partidos.index', ['torneo_id' => $partido->torneo_id])
            ->with('success', 'Partido y resultado actualizados exitosamente.');
    }

    public function destroy(Partido $partido)
    {
        $torneoId = $partido->torneo_id;
        $fase = $partido->fase;
        $eraFinalizado = ($partido->estado === 'finalizado');

        $partido->delete();

        if ($eraFinalizado && $fase) {
            $this->tablaService->recalcular($fase);
        }

        return redirect()->route('admin.partidos.index', ['torneo_id' => $torneoId])
            ->with('success', 'Partido eliminado exitosamente.');
    }
}
