<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\EquipoCompeticion;
use App\Models\Estadio;
use App\Models\Fase;
use App\Models\Partido;
use App\Models\Torneo;
use Illuminate\Http\Request;

class EquipoController extends Controller
{
    // Todos los clubes
    public function index()
    {
        $equipos = Equipo::orderBy('nombre')->get();
        return view('equipos.index', compact('equipos'));
    }

    public function create() {}

    public function store(Request $request)
    {
        //
    }

    // Mostrar un equipo
    public function show(Equipo $equipo)
    {
        // Torneo principal
        $torneo = Torneo::orderBy('estado', 'asc')
                    ->orderByDesc('temporada')
                    ->where('categoria', 'Primera')
                    ->first();

        $tabla = EquipoCompeticion::where('equipo_id', $equipo->id)
            ->whereHas('fase', function ($q) use ($torneo) {
                $q->where('torneo_id', $torneo->id);
            })
            ->with('equipo')
            ->get()
            ->groupBy('fase_id');


        // - ULTIMOS PARTIDOS DEL EQUIPO -
        $ultimosPartidos = Partido::where('torneo_id', $torneo->id)
            ->where('estado', 'finalizado')
            ->where(function ($query) use ($equipo) {
                $query->where('equipo_local_id', $equipo->id)
                    ->orWhere('equipo_visitante_id', $equipo->id);
            })
            ->orderBy('fecha_partido', 'desc')
            ->take(7)
            ->get();

        // - TOTAL DE EQUIPOS QUE PARTICIPAN EN SU ZONA -
        $idFase = $tabla->first()->first()->fase_id;
        $idZona = $tabla->first()->first()->zona_id;

        $totalEquipos = EquipoCompeticion::where('fase_id', $idFase)
            ->where('zona_id', $idZona)
            ->count();

        // - POSICION EN LA ZONA -
        $tablaCompleta = EquipoCompeticion::where('fase_id', $idFase)
            ->where('zona_id', $idZona)
            ->orderByDesc('puntos')
            ->orderByDesc('diferencia_goles')
            ->orderByDesc('goles_favor')
            ->get();

        //var_dump($tablaCompleta);
        $posicion = $tablaCompleta->search(function ($item) use ($equipo) {
            return $item->equipo_id === $equipo->id;
        });
        $posicion = $posicion !== false ? $posicion + 1 : null;
        //var_dump($posicion);
        //die();

        // - STATS DEL EQUIPO -
        $equipoTabla = $tabla->first()->first();

        // - PROXIMO PARTIDO -
        $proximoPartido = Partido::where('torneo_id', $torneo->id)
            ->where('estado', 'programado')
            ->where(function ($query) use ($equipo) {
                $query->where('equipo_local_id', $equipo->id)
                    ->orWhere('equipo_visitante_id', $equipo->id);
            })
            // ->whereDate('fecha', '>=', now()->toDateString()) DESCOMENTAR ESTO
            ->orderBy('fecha_partido')
            ->orderBy('hora_partido')
            ->with(['local', 'visitante'])
            ->first();

        // - ESTADIO -
        $estadio = Estadio::where('id', $equipo->estadio_id)->first();

        return view('equipos.show', compact(
            'equipo',
            'torneo',
            'ultimosPartidos',
            'posicion',
            'totalEquipos',
            'equipoTabla',
            'proximoPartido',
            'estadio'
        ));
    }

    public function edit(Equipo $equipo)
    {
        //
    }

    public function update(Request $request, Equipo $equipo)
    {
        //
    }

    public function destroy(Equipo $equipo)
    {
        //
    }
}
