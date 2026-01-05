<?php

namespace App\Http\Controllers;

use App\Models\Partido;
use App\Services\TablaPosicionesService;
use Illuminate\Http\Request;

class PartidoController extends Controller
{
    //Recalcula cada vez que el partido se guarde
    public function update(Request $request, Partido $partido, TablaPosicionesService $tablaService)
    {
        $partido->update($request->all());

        if ($partido->estado === 'finalizado') {
            $tablaService->recalcular($partido->torneo);
        }

        return redirect()->back();
    }
}
