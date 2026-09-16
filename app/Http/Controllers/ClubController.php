<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Partido;
use App\Models\Torneo;
use App\Models\Zona;
use App\Models\EquipoCompeticion;
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

        # Fase y zonas
        $fase = $torneo?->fases->first();
        $zona = $fase ? Zona::where('fase_id', $fase->id)->first() : null;

        # Tabla de posiciones ordenada por criterios de clasificación
        $tabla = $zona
            ? EquipoCompeticion::where('zona_id', $zona->id)
                ->orderByDesc('puntos')
                ->orderByDesc('diferencia_goles')
                ->orderByDesc('goles_favor')
                ->with('equipo.club')
                ->get()
            : collect();

        # Cantidad de equipos en la zona/torneo
        $cantidadEquipos = $tabla->count();

        # Posición del club en la tabla (índice 0-based + 1)
        $posicionIndex = $tabla->search(function ($item) use ($club) {
            return $item->equipo?->club_id === $club->id;
        });

        $posicion = $posicionIndex !== false ? $posicionIndex + 1 : null;
        $equipoTabla = $posicionIndex !== false ? $tabla->get($posicionIndex) : null;
        
        # Ultimos partidos 
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

        # Proximo partido
        $proximoPartido = Partido::with(['local.club', 'visitante.club', 'estadio', 'torneo.temporada'])
            ->where('torneo_id', $torneo->id)
            ->where(function ($query) use ($club) {
                $query->where('equipo_local_id', $club->id)
                    ->orWhere('equipo_visitante_id', $club->id);
            })
            ->whereNotNull('fecha_hora')
            ->orderBy('fecha_hora')
            ->first();

        #dd($ultimosPartidos);

        return view('clubes.show', compact('club', 'torneo', 'equipoTabla', 'ultimosPartidos','cantidadEquipos','posicion','proximoPartido'));
    }

}
