<?php

namespace App\Http\Controllers;

use App\Models\Partido;
use Illuminate\Http\Request;

class PartidoController
{
    public function index()
    {
        $partidos = Partido::orderBy('fecha_hora')->get();
        return view('partidos.index', compact('partidos'));
    }
}
