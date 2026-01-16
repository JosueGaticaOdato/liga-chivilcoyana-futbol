<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use App\Models\Partido;
use App\Models\Torneo;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Torneo principal
        $torneo = Torneo::orderBy('estado', 'asc')->first();

        // Tabla
        $tabla = $torneo
            ? $torneo->equipos()
                ->orderByDesc('pivot_puntos')
                ->orderByDesc('pivot_diferencia_goles')
                ->orderByDesc('pivot_goles_favor')
                ->take(8)
                ->get()
            : collect();

        // Partidos recientes
        // $partidosRecientes = Partido::with(['local', 'visitante'])
        //     ->orderByDesc('fecha')
        //     ->orderByDesc('hora')
        //     ->take(3)
        //     ->get();

        $partidosRecientes = $torneo->partidos()
            ->with(['local', 'visitante'])
            ->orderBy('fecha_partido') //Orden cronologico
            ->orderBy('hora_partido')
            ->limit(3)
            ->get();
        // // Noticias
        $noticias = Noticia::orderByDesc('created_at')
            ->take(3)
            ->get();

        return view('home.index', compact(
            'torneo',
            'tabla',
            'partidosRecientes',
            'noticias'
        ));
    }
}
