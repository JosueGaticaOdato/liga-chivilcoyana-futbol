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

    public function index2()
    {
        $torneos = Torneo::orderBy('nombre')->get();
        return view('torneos.index2', compact('torneos'));
    }

    public function torneo(Torneo $torneo){

        $fases = $torneo->fases()->get();

        $zona = Zona::where('fase_id', $fases->first()->id)->first();

        $tabla = EquipoCompeticion::where('zona_id', $zona->id)->orderByDesc('puntos')->get();

        $cantidadEquipos = $tabla->count();

        // $partidos = Partido::where('torneo_id', $torneo->id)->get();

        $limite = 4;

        return view('torneos.torneo', compact(
            'torneo',
            'fases',
            'tabla',
            'zona',
            'limite',
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

}
