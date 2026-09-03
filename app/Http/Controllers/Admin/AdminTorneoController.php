<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\TorneoRequest;
use App\Models\Categoria;
use App\Models\Club;
use App\Models\Equipo;
use App\Models\EquipoCompeticion;
use App\Models\Fase;
use App\Models\Temporada;
use App\Models\Torneo;
use App\Models\Zona;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminTorneoController
{
    public function index(Request $request)
    {
        $query = Torneo::with(['categoria', 'temporada'])
            ->withCount('partidos');

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        if ($request->filled('temporada_id')) {
            $query->where('temporada_id', $request->temporada_id);
        }

        if ($request->filled('categoria_id')) {
            $query->where('categoria_id', $request->categoria_id);
        }

        if ($request->filled('buscar')) {
            $query->where('nombre', 'like', '%' . $request->buscar . '%');
        }

        $torneos = $query->orderByDesc('id')->paginate(10)->withQueryString();
        $temporadas = Temporada::orderByDesc('nombre')->get();
        $categorias = Categoria::orderBy('orden')->get();

        return view('admin.torneos.index', compact('torneos', 'temporadas', 'categorias'));
    }

    public function create()
    {
        $temporadas = Temporada::orderByDesc('nombre')->get();
        $categorias = Categoria::orderBy('orden')->get();
        $clubes = Club::with('equipos')->where('activo', true)->orderBy('nombre')->get();
        $equipos = Equipo::with('club', 'categoria')->where('activo', true)->orderBy('nombre')->get();

        return view('admin.torneos.create', compact('temporadas', 'categorias', 'clubes', 'equipos'));
    }

    public function store(TorneoRequest $request)
    {
        $data = $request->validated();

        $categoria = Categoria::find($data['categoria_id']);
        $temporada = Temporada::find($data['temporada_id']);

        if (empty($data['slug'])) {
            $baseSlug = Str::slug("{$categoria->nombre}-{$data['nombre']}-{$temporada->nombre}");
            $slug = $baseSlug;
            $count = 1;
            while (Torneo::where('slug', $slug)->exists()) {
                $slug = "{$baseSlug}-{$count}";
                $count++;
            }
            $data['slug'] = $slug;
        }

        $tipoFase = $request->input('tipo_fase', 'round_robin');
        $nombreFase = $request->input('nombre_fase');

        if (empty($nombreFase)) {
            $nombreFase = match ($tipoFase) {
                'round_robin' => 'Todos contra todos',
                'eliminacion_simple' => 'Eliminación Directa',
                'eliminacion_ida_vuelta' => 'Play-offs (Ida y Vuelta)',
                default => 'Fase Inicial',
            };
        }

        $torneo = Torneo::create($data);

        // Crear la fase inicial con el tipo indicado por el usuario
        $fase = Fase::create([
            'torneo_id' => $torneo->id,
            'nombre' => $nombreFase,
            'orden' => 1,
            'tipo' => $tipoFase,
        ]);

        $zona = Zona::create([
            'fase_id' => $fase->id,
            'nombre' => 'General',
        ]);

        // Resolver y crear los equipos participantes específicamente para esta categoría
        $equipoIds = $this->resolverEquiposParticipantes($request, (int) $data['categoria_id']);

        foreach ($equipoIds as $eqId) {
            EquipoCompeticion::create([
                'zona_id' => $zona->id,
                'equipo_id' => $eqId,
                'estado' => 'activo',
                'sembrado' => null,
                'partidos_jugados' => 0,
                'ganados' => 0,
                'empatados' => 0,
                'perdidos' => 0,
                'goles_favor' => 0,
                'goles_contra' => 0,
                'puntos' => 0,
                'puntos_deducidos' => 0,
            ]);
        }

        $count = count($equipoIds);
        return redirect()->route('admin.torneos.index')
            ->with('success', "Torneo '{$torneo->nombre}' ({$categoria->nombre}) creado exitosamente con {$count} equipos participantes.");
    }

    public function edit(Torneo $torneo)
    {
        $temporadas = Temporada::orderByDesc('nombre')->get();
        $categorias = Categoria::orderBy('orden')->get();
        $clubes = Club::with('equipos')->where('activo', true)->orderBy('nombre')->get();
        $equipos = Equipo::with('club', 'categoria')->where('activo', true)->orderBy('nombre')->get();

        $primeraFase = $torneo->fases()->orderBy('orden')->first();
        $primeraZona = $primeraFase ? $primeraFase->zonas()->first() : null;
        $participantesIds = $primeraZona ? EquipoCompeticion::where('zona_id', $primeraZona->id)->pluck('equipo_id')->toArray() : [];

        // Obtener los IDs de clubes que ya participan a través de sus equipos
        $participantesClubIds = Equipo::whereIn('id', $participantesIds)->pluck('club_id')->toArray();

        return view('admin.torneos.edit', compact(
            'torneo',
            'temporadas',
            'categorias',
            'clubes',
            'equipos',
            'primeraFase',
            'participantesIds',
            'participantesClubIds'
        ));
    }

    public function update(TorneoRequest $request, Torneo $torneo)
    {
        $data = $request->validated();

        if (empty($data['slug'])) {
            $categoria = Categoria::find($data['categoria_id']);
            $temporada = Temporada::find($data['temporada_id']);
            $baseSlug = Str::slug("{$categoria->nombre}-{$data['nombre']}-{$temporada->nombre}");
            $slug = $baseSlug;
            $count = 1;
            while (Torneo::where('slug', $slug)->where('id', '!=', $torneo->id)->exists()) {
                $slug = "{$baseSlug}-{$count}";
                $count++;
            }
            $data['slug'] = $slug;
        }

        $torneo->update($data);

        // Actualizar la fase inicial si se especificó un tipo
        $primeraFase = $torneo->fases()->orderBy('orden')->first();
        if ($primeraFase) {
            if ($request->filled('tipo_fase')) {
                $tipoFase = $request->input('tipo_fase');
                $nombreFase = $request->input('nombre_fase');
                if (empty($nombreFase)) {
                    $nombreFase = match ($tipoFase) {
                        'round_robin' => 'Todos contra todos',
                        'eliminacion_simple' => 'Eliminación Directa',
                        'eliminacion_ida_vuelta' => 'Play-offs (Ida y Vuelta)',
                        default => $primeraFase->nombre,
                    };
                }
                $primeraFase->update([
                    'tipo' => $tipoFase,
                    'nombre' => $nombreFase,
                ]);
            }

            // Sincronizar equipos participantes de la primera fase
            $primeraZona = $primeraFase->zonas()->first();
            if ($primeraZona) {
                $equipoIds = $this->resolverEquiposParticipantes($request, (int) $data['categoria_id']);

                // Desvincular equipos desmarcados
                EquipoCompeticion::where('zona_id', $primeraZona->id)
                    ->whereNotIn('equipo_id', $equipoIds)
                    ->delete();

                // Vincular equipos seleccionados
                foreach ($equipoIds as $eqId) {
                    EquipoCompeticion::firstOrCreate(
                        [
                            'zona_id' => $primeraZona->id,
                            'equipo_id' => $eqId,
                        ],
                        [
                            'estado' => 'activo',
                            'sembrado' => null,
                            'partidos_jugados' => 0,
                            'ganados' => 0,
                            'empatados' => 0,
                            'perdidos' => 0,
                            'goles_favor' => 0,
                            'goles_contra' => 0,
                            'puntos' => 0,
                            'puntos_deducidos' => 0,
                        ]
                    );
                }
            }
        }

        return redirect()->route('admin.torneos.index')
            ->with('success', "Torneo '{$torneo->nombre}' actualizado exitosamente.");
    }

    public function destroy(Torneo $torneo)
    {
        $nombre = $torneo->nombre;
        $torneo->delete();

        return redirect()->route('admin.torneos.index')
            ->with('success', "Torneo '{$nombre}' eliminado correctamente.");
    }

    /**
     * Resuelve y asegura la existencia de los equipos de la categoría seleccionada
     */
    private function resolverEquiposParticipantes(Request $request, int $categoriaId): array
    {
        $equipoIds = [];

        // 1. Clubes seleccionados (marcan su equipo principal en esta categoría)
        if ($request->filled('club_ids')) {
            foreach ($request->input('club_ids') as $clubId) {
                $club = Club::find($clubId);
                if ($club) {
                    $equipo = Equipo::firstOrCreate(
                        [
                            'club_id' => $clubId,
                            'categoria_id' => $categoriaId,
                        ],
                        [
                            'nombre' => $club->nombre,
                            'activo' => true,
                        ]
                    );
                    $equipoIds[] = $equipo->id;
                }
            }
        }

        // 2. Equipos IDs seleccionados directamente
        if ($request->filled('equipos')) {
            foreach ($request->input('equipos') as $eqId) {
                $equipo = Equipo::find($eqId);
                if ($equipo) {
                    if ($equipo->categoria_id != $categoriaId) {
                        $equipo = Equipo::firstOrCreate(
                            [
                                'club_id' => $equipo->club_id,
                                'categoria_id' => $categoriaId,
                            ],
                            [
                                'nombre' => $equipo->nombre ?: ($equipo->club?->nombre ?? 'Equipo'),
                                'activo' => true,
                            ]
                        );
                    }
                    $equipoIds[] = $equipo->id;
                }
            }
        }

        // 3. Nuevos equipos registrados al vuelo (ej: "Colón B")
        if ($request->filled('nuevos_equipos')) {
            foreach ($request->input('nuevos_equipos') as $nuevo) {
                if (!empty($nuevo['club_id']) && !empty($nuevo['nombre'])) {
                    $equipoCreado = Equipo::firstOrCreate(
                        [
                            'club_id' => $nuevo['club_id'],
                            'categoria_id' => $categoriaId,
                            'nombre' => $nuevo['nombre'],
                        ],
                        [
                            'activo' => true,
                        ]
                    );
                    $equipoIds[] = $equipoCreado->id;
                }
            }
        }

        return array_values(array_unique($equipoIds));
    }
}
