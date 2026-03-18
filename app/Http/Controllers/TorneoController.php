<?php

namespace App\Http\Controllers;

use App\Models\EquipoCompeticion;
use App\Models\Fecha;
use App\Models\Partido;
use App\Models\Torneo;
use Illuminate\Http\Request;

class TorneoController extends Controller
{

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

        // Fase de grupos (si tiene)
        $faseGrupos = $fases->firstWhere('tipo', 'liga');

        $tablas = collect();

        if ($faseGrupos) {
            // Caso con zonas
            if ($faseGrupos->zonas->count() > 0) {

                foreach ($faseGrupos->zonas as $zona) {

                    $tabla = EquipoCompeticion::where('fase_id', $faseGrupos->id)
                        ->where('zona_id', $zona->id)
                        ->orderByDesc('puntos')
                        ->orderByDesc('diferencia_goles')
                        ->orderByDesc('goles_favor')
                        ->with('equipo')
                        ->get();

                    $tablas->push([
                        'zona' => $zona,
                        'tabla' => $tabla
                    ]);
                }
            } else {
                // Liga simple (sin zonas)
                $tabla = EquipoCompeticion::where('fase_id', $faseGrupos->id)
                    ->whereNull('zona_id')
                    ->orderByDesc('puntos')
                    ->orderByDesc('diferencia_goles')
                    ->orderByDesc('goles_favor')
                    ->with('equipo')
                    ->get();

                $tablas->push([
                    'zona' => null,
                    'tabla' => $tabla
                ]);
            }
        }

        // Próximos partidos (de TODO el torneo)
        $proximosPartidos = Partido::where('torneo_id', $torneo->id)
            ->where('estado', 'programado')
            ->with(['local', 'visitante'])
            ->orderBy('fecha_partido')
            ->orderBy('hora_partido')
            ->limit(3)
            ->get();

        //$cantidadEquipos = $torneo->equipos()->count();
        $cantidadEquipos = 2;

        //var_dump($tablas);

        return view('torneos.torneo', compact(
            'torneo',
            'fases',
            'tablas',
            'proximosPartidos',
            'cantidadEquipos'
        ));
    }

    public function tabla(Torneo $torneo)
    {
        $equipos = $torneo->equipos()
            ->orderByDesc('pivot_puntos')
            ->orderByDesc('pivot_diferencia_goles')
            ->orderByDesc('pivot_goles_favor')
            ->get();

        /**
         * Orden por:
         * 1. Puntos
         * 2. Diferencia de gol
         * 3. Goles a favor
         */

        return view('torneos.tabla', compact('torneo', 'equipos'));
    }

    public function fixture(Torneo $torneo, ?int $fecha = null)
    {

        //die();
        if ($fecha === null) {
            $fecha = $torneo->fechas()
                ->whereHas('partidos', function ($q) {
                    $q->where('estado', '!=', 'finalizado');
                })
                ->orderBy('numero')
                ->value('numero')
                ?? $torneo->fechas()->max('numero');
        }

        $fechaActual = $torneo->fechas()
            ->where('id', $fecha)
            ->with([
                'partidos.local',
                'partidos.visitante'
            ])
            ->firstOrFail();
        var_dump($fechaActual);

        $fechas = $torneo->fechas()
            ->orderBy('id')
            ->get();

        return view('torneos.fixture', compact(
            'torneo',
            'fechaActual',
            'fechas'
        ));
    }
}
