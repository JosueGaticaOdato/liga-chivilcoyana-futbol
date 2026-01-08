<?php

namespace App\Http\Controllers;

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
                ->take(5)
                ->get()
            : collect();

        // Partidos recientes
        $partidosRecientes = Partido::with(['local', 'visitante'])
            ->where('estado', 'finalizado')
            ->orderByDesc('fecha')
            ->orderByDesc('hora')
            ->take(5)
            ->get();

        // // Noticias
        // $noticias = Noticia::where('destacada', true)
        //     ->orderByDesc('created_at')
        //     ->take(3)
        //     ->get();

        return view('home.index', compact(
            'torneo',
            'tabla',
            'partidosRecientes',
            // 'noticias'
        ));
    }
}
