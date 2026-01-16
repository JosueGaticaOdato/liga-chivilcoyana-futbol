<?php

namespace App\Http\Controllers;

use App\Models\Partido;
use App\Models\Torneo;
use App\Services\TablaPosicionesService;
use Illuminate\Http\Request;

class PartidoController extends Controller
{
    public function index(Request $request)
    {
        $query = Partido::with(['torneo', 'local', 'visitante']);

        // Filtro por categoría (desde torneo)
        if ($request->filled('categoria')) {
            $query->whereHas('torneo', function ($q) use ($request) {
                $q->where('categoria', $request->categoria);
            });
        }

        // Filtro por fecha
        if ($request->filled('fecha')) {
            $query->whereDate('fecha', $request->fecha);
        }

        // Filtro por estado
        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        $partidos = $query
            ->orderBy('fecha_partido')
            ->orderBy('hora_partido')
            ->get();

        // Para los filtros
        $categorias = Torneo::select('categoria')
            ->distinct()
            ->orderBy('categoria')
            ->pluck('categoria');

        return view('partidos.index', compact(
            'partidos',
            'categorias'
        ));
    }


    //Recalcula cada vez que el partido se guarde
    public function update(Request $request, Partido $partido, TablaPosicionesService $tablaService)
    {
        $partido->update($request->all());

        if ($partido->estado === 'finalizado') {
            $tablaService->recalcular($partido->torneo);
        }

        return redirect()->back();
    }

    public function show(Partido $partido)
    {
        $partido->load(['torneo', 'fecha']);

        return view('partidos.show', compact('partido'));
    }
}
