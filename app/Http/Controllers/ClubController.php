<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Partido;
use App\Models\Torneo;
use Illuminate\Http\Request;

class ClubController
{
    //
    public function index()
    {
        $clubes = Club::orderBy('nombre')->get();
        return view('clubes.index', compact('clubes'));
    }

    public function show(Club $club)
    {
        # Traigo el torneo de primera vigente
        $torneo = Torneo::with(['categoria', 'temporada', 'fases'])
            ->whereHas('categoria', function ($query) {
                $query->where('nombre', 'Primera');
            })
            ->where('estado', 'en_curso')
            ->orderByDesc('fecha_inicio')
            ->first();
            
        $limite = 3;

        $ultimosPartidos =  Partido::with(['local.club', 'visitante.club', 'estadio', 'torneo.temporada'])
            ->where('torneo_id', $torneo->id)
            ->where(function ($query) use ($club) {
                $query->where('equipo_local_id', $club->id)
                    ->orWhere('equipo_visitante_id', $club->id);
            })
            ->whereNotNull('fecha_hora')
            ->orderByDesc('fecha_hora')
            ->limit($limite)
            ->get();

        #dd($ultimosPartidos);

        return view('clubes.show', compact('club', 'ultimosPartidos'));
    }

}
