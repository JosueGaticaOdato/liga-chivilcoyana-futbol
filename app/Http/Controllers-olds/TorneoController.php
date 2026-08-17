<?php

namespace App\Http\Controllers;

use App\Models\EquipoCompeticion;
use App\Models\Fecha;
use App\Models\Partido;
use App\Models\Torneo;
use App\Models\Zona;
use App\Services\TablaService;
use Illuminate\Http\Request;

class TorneoController extends Controller
{
    protected $tablaService;

    public function __construct(TablaService $tablaService)
    {
        $this->tablaService = $tablaService;
    }

    public function index()
    {
        $torneos = Torneo::orderBy('estado', 'asc')
            ->orderBy('nombre', 'asc')
            ->get();
        return view('torneos.index', compact('torneos'));
    }

    public function torneo(Torneo $torneo)
    {
        // Fases del torneo
        $fases = $torneo->fases()->with('zonas')->get();

        $tablas = $this->tablaService->getTabla($torneo, $fases);

        // Próximos partidos (de TODO el torneo)
        $proximosPartidos = Partido::where('torneo_id', $torneo->id)
            // ->where('estado', 'programado')
            ->with(['local', 'visitante'])
            ->orderBy('fecha_partido')
            ->orderBy('hora_partido')
            ->limit(3)
            ->get();

        $cantidadEquipos = EquipoCompeticion::whereHas('fase', function ($q) use ($torneo) {
            $q->where('torneo_id', $torneo->id);
        })->count();

        $limite = 4;

        //dump($tablas);

        //var_dump($tablas);

        return view('torneos.torneo', compact(
            'torneo',
            'fases',
            'tablas',
            'proximosPartidos',
            'limite',
            'cantidadEquipos'
        ));
    }

    public function tabla(Torneo $torneo)
    {
        // Fases del torneo
        $fases = $torneo->fases()->with('zonas')->get();

        $tablas = $this->tablaService->getTabla($torneo, $fases);

        /**
         * Orden por:
         * 1. Puntos
         * 2. Diferencia de gol
         * 3. Goles a favor
         */

        return view('torneos.tabla', compact('torneo', 'tablas'));
    }

    public function fixture(Torneo $torneo, ?int $fecha = null)
    {

        // Si no se proporciona una fecha, buscamos la primera fecha que tenga partidos no finalizados
        if ($fecha === null){
            $fecha = $torneo->fases()
                ->with('fechas')
                ->get()
                ->flatMap(fn($fase) => $fase->fechas)
                ->where('partidos', '!=', null)
                ->firstWhere('partidos.*.estado', '!=', 'finalizado')
                ->id ?? $torneo->fases()
                    ->with('fechas')
                    ->get()
                    ->flatMap(fn($fase) => $fase->fechas)
                    ->max('id');
        }

        $partidos = Partido::where('torneo_id', $torneo->id)
            ->where('fecha_id', $fecha)
            ->with(['local', 'visitante'])
            ->orderBy('fecha_partido')
            ->orderBy('hora_partido')
            ->get();

        $fases = $torneo->fases()->with('zonas')->get();

        // Traigo todas las fechas (sin importar zona o fase)
        $fechas = collect();
        foreach ($fases as $fase) {
            $fechas = $fechas->merge($fase->fechas()->orderBy('id')->get());
        }

        // Necesitamos obtener los datos de la fecha proporcionada por el usuario
        $fechaActual = $fechas->firstWhere('id', $fecha);

        return view('torneos.fixture', compact(
            'torneo',
            'partidos',
            'fechas',
            'fechaActual'
        ));
    }

    public function tablaRedes(Torneo $torneo, Zona $zona)
    {
        // Fases del torneo
        $fases = $torneo->fases()->with('zonas')->get();

        $zonaTorneo = $fases->flatMap(fn($fase) => $fase->zonas)
            ->firstWhere('id', $zona->id);
        //var_dump($zonaTorneo);

        $tablas = $this->tablaService->getTabla($torneo, $fases);

        // TO-DO: Filtrar la tabla para mostrar solo la zona seleccionada
        $tablaZona = $tablas->firstWhere('zona.id', $zona->id);

        $tabla = $tablaZona['tabla'] ?? collect();
        //var_dump($tabla);

        return view('redes.tabla', compact('torneo', 'tabla', 'zonaTorneo'));
    }
}
