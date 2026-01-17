<?php

namespace App\Http\Controllers;

use App\Models\Fecha;
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
        // Tabla de posiciones (Top 5)
        $tabla = $torneo->equipos()
            ->orderByDesc('pivot_puntos')
            ->orderByDesc('pivot_diferencia_goles')
            ->orderByDesc('pivot_goles_favor')
            ->limit(5)
            ->get();

        $proximosPartidos = $torneo->partidos()
            ->with(['local', 'visitante'])
            ->orderBy('fecha_partido') //Orden cronologico
            ->orderBy('hora_partido')
            ->limit(3)
            ->get();

        $cantidadEquipos = $torneo->equipos()->count();

        return view('torneos.torneo', compact(
            'torneo',
            'tabla',
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
        if ($fecha === null) {
            $fecha = Fecha::where('torneo_id', $torneo->id)
                ->whereHas('partidos', function ($q) {
                    $q->where('estado', '!=', 'finalizado');
                })
                ->orderBy('numero')
                ->value('numero')
                ?? Fecha::where('torneo_id', $torneo->id)
                ->max('numero');
        }

        $fechaActual = Fecha::where('torneo_id', $torneo->id)
            ->where('numero', $fecha)
            ->with([
                'partidos.local',
                'partidos.visitante'
            ])
            ->firstOrFail();

        $fechas = Fecha::where('torneo_id', $torneo->id)
            ->orderBy('numero')
            ->get();

        return view('torneos.fixture', compact(
            'torneo',
            'fechaActual',
            'fechas'
        ));
    }
}
