<?php

namespace App\Http\Controllers;

use App\Models\EquipoCompeticion;
use App\Models\Partido;
use App\Models\Torneo;
use App\Models\Zona;

class HomeController
{
    public function index()
    {
        $cant_equipos_tabla = 10;

        # Traer siempre el torneo de primera división en curso, si no hay ninguno, traer el último torneo de primera división finalizado
        $torneo = Torneo::with(['categoria', 'temporada', 'fases'])
            ->whereHas('categoria', function ($query) {
                $query->where('nombre', 'Primera');
            })
            ->where('estado', 'en_curso')
            ->orderByDesc('fecha_inicio')
            ->first();

        $zona = null;
        $tabla = collect();
        $partidosRecientes = collect();

        if ($torneo) {
            $fase = $torneo->fases->sortBy('orden')->first();
            $zona = $fase ? Zona::where('fase_id', $fase->id)->first() : null;

            if ($zona) {
                $tabla = EquipoCompeticion::with('equipo.club')
                    ->where('zona_id', $zona->id)
                    ->orderByDesc('puntos')
                    ->orderByDesc('diferencia_goles')
                    ->orderByDesc('goles_favor')
                    ->get();
            }

            $partidosRecientes = Partido::with(['local.club', 'visitante.club', 'estadio', 'torneo.temporada'])
                ->where('torneo_id', $torneo->id)
                ->whereNotNull('fecha_hora')
                ->orderByDesc('fecha_hora')
                ->limit(4)
                ->get();
        }

        return view('home.index', compact('torneo', 'zona', 'tabla', 'partidosRecientes', 'cant_equipos_tabla'));
    }
}
