<?php

namespace App\Http\Controllers;

use App\Models\Fase;
use App\Models\Torneo;
use App\Models\Zona;
use App\Models\Partido;
use App\Models\EquipoCompeticion;
use Illuminate\Http\Request;

class TorneoController
{
    public function index()
    {
        $torneos = Torneo::orderBy('nombre')->get();
        return view('torneos.index', compact('torneos'));
    }

    public function torneo(Torneo $torneo){

        $fases = $torneo->fases()->get();

        $zona = Zona::where('fase_id', $fases->first()->id)->first();

        $tabla = EquipoCompeticion::where('zona_id', $zona->id)->orderByDesc('puntos')->get();

        $cantidadEquipos = $tabla->count();

        $partidos = Partido::where('torneo_id', $torneo->id)
            ->orderBy('fecha_hora')
            ->limit(3)
            ->get();

        $limite = 8;

        return view('torneos.torneo', compact(
            'torneo',
            'fases',
            'tabla',
            'zona',
            'limite',
            'partidos',
            'cantidadEquipos'
        ));
    }

    public function tabla(Torneo $torneo)
    {
        // Fases del torneo
        $fases = $torneo->fases()->get();

        $zona = Zona::where('fase_id', $fases->first()->id)->first();

        $tabla = EquipoCompeticion::where('zona_id', $zona->id)->orderByDesc('puntos')->get();

        /**
         * Orden por:
         * 1. Puntos
         * 2. Diferencia de gol
         * 3. Goles a favor
         */

        return view('torneos.tabla', compact('torneo', 'tabla'));
    }

    public function fixture(Torneo $torneo, $fecha = null)
    {
        // Obtener las jornadas únicas disponibles para el torneo ordenadas numéricamente
        $jornadas = Partido::where('torneo_id', $torneo->id)
            ->whereNotNull('jornada')
            ->distinct()
            ->orderBy('jornada')
            ->pluck('jornada');

        // Determinar la jornada activa seleccionada
        $jornadaActual = null;
        if ($fecha !== null && $jornadas->contains((int)$fecha)) {
            $jornadaActual = (int)$fecha;
        } elseif ($jornadas->isNotEmpty()) {
            $jornadaActual = (int)$jornadas->first();
        }

        // Obtener los partidos de la jornada seleccionada
        $partidos = collect();
        if ($jornadaActual !== null) {
            $partidos = Partido::where('torneo_id', $torneo->id)
                ->where('jornada', $jornadaActual)
                ->with(['local.club', 'visitante.club', 'estadio', 'torneo.temporada'])
                ->orderBy('fecha_hora')
                ->get();
        }

        return view('torneos.fixture', compact(
            'torneo',
            'jornadas',
            'jornadaActual',
            'partidos'
        ));
    }

}
