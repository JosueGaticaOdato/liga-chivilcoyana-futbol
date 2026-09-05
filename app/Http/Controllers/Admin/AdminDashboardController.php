<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Club;
use App\Models\Equipo;
use App\Models\Partido;
use App\Models\Torneo;
use Illuminate\Http\Request;

class AdminDashboardController
{
    public function index()
    {
        $stats = [
            'torneos_total' => Torneo::count(),
            'torneos_activos' => Torneo::where('estado', 'en_curso')->count(),
            'torneos_en_curso' => Torneo::where('estado', 'en_curso')->count(),
            'partidos_total' => Partido::count(),
            'partidos_programados' => Partido::where('estado', 'programado')->count(),
            'partidos_finalizados' => Partido::where('estado', 'finalizado')->count(),
            'clubes_total' => Club::count(),
            'clubes_activos' => Club::where('activo', true)->count(),
            'equipos_total' => Equipo::count(),
        ];

        $torneosActivos = Torneo::with(['categoria', 'temporada'])
            ->where('estado', 'en_curso')
            ->orderByDesc('fecha_inicio')
            ->take(5)
            ->get();

        $proximosPartidos = Partido::with(['local.club', 'visitante.club', 'torneo', 'estadio'])
            ->where('estado', 'programado')
            ->orderBy('fecha_hora')
            ->take(6)
            ->get();

        $ultimosResultados = Partido::with(['local.club', 'visitante.club', 'torneo'])
            ->where('estado', 'finalizado')
            ->orderByDesc('fecha_hora')
            ->take(6)
            ->get();

        return view('admin.dashboard', compact(
            'stats',
            'torneosActivos',
            'proximosPartidos',
            'ultimosResultados'
        ));
    }
}
