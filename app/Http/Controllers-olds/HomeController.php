<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use App\Models\Partido;
use App\Models\Torneo;
use App\Services\TablaService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $tablaService;

    public function __construct(TablaService $tablaService)
    {
        $this->tablaService = $tablaService;
    }

    public function index()
    {
        $cant_equipos_tabla = 4;
        $cant_partidos = 4;
        $cant_noticias = 3;

        // Torneo principal
        $torneo = Torneo::orderBy('estado', 'asc')
                    ->orderByDesc('temporada')
                    ->where('categoria', 'Primera')
                    ->first();

        $fases = $torneo->fases()->with('zonas')->get();
        $tablas = $this->tablaService->getTabla($torneo, $fases);

        //Si no tiene zonas, muestro los mejores 8
        if(($fases->firstWhere('tipo', 'liga')->zonas->count() ?? 0) == 0) {
            $cant_equipos_tabla = 8;
        }

        // Partidos recientes
        $partidosRecientes = Partido::with(['local', 'visitante'])
            ->where('torneo_id', $torneo->id)
            ->orderByDesc('fecha_partido')
            ->orderByDesc('hora_partido')
            ->limit($cant_partidos)
            ->get();
        // // Noticias
        $noticias = Noticia::orderByDesc('created_at')
            ->take($cant_noticias)
            ->get();

        return view('home.index', compact(
            'torneo',
            'tablas',
            'cant_equipos_tabla',
            'partidosRecientes',
            'noticias'
        ));
    }
}
