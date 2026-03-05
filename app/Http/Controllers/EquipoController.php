<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Estadio;
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
        $torneo = Torneo::orderBy('estado', 'asc')->first();

        // - ULTIMOS PARTIDOS DEL EQUIPO -
        $ultimosPartidos = Partido::where('torneo_id', $torneo->id)
            ->where('estado', 'finalizado')
            ->where(function ($query) use ($equipo) {
                $query->where('equipo_local_id', $equipo->id)
                    ->orWhere('equipo_visitante_id', $equipo->id);
            })
            ->orderBy('fecha_partido', 'desc')
            ->take(3)
            ->get();

        // - DATOS DE EQUIPOS EN EL TORNEO -
        // Obtengo la tabla y luego los datos de ese equipo en el tonroe
        $tabla = $torneo->equipos()
            ->orderByDesc('pivot_puntos')
            ->orderByDesc('pivot_diferencia_goles')
            ->orderByDesc('pivot_goles_favor')
            ->get();

        // Total de equipos
        $totalEquipos = $tabla->count();

        // Posición del equipo actual (index + 1)
        $posicion = $tabla->search(function ($item) use ($equipo) {
            return $item->id === $equipo->id;
        });
        $posicion = $posicion !== false ? $posicion + 1 : null;

        // Stats del equipo
        $equipoTabla = $tabla->firstWhere('id', $equipo->id);

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
        //var_dump($estadio);


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
