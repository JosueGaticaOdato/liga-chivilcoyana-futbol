<?php

namespace App\Http\Controllers;

use App\Models\Torneo;
use Illuminate\Http\Request;

class TorneoController extends Controller
{

    public function index()
    {
        $torneos = Torneo::orderBy('nombre')->get();
        return view('torneos.index', compact('torneos'));
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

    public function partidos(Torneo $torneo)
    {
        $partidos = $torneo->partidos()
            ->with(['local', 'visitante'])
            ->orderBy('fecha') //Orden cronologico
            ->orderBy('hora')
            ->get();

        return view('torneos.partidos', compact('torneo', 'partidos'));
    }
}
