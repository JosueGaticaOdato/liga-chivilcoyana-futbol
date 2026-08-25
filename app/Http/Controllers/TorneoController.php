<?php

namespace App\Http\Controllers;

use App\Models\Torneo;
use Illuminate\Http\Request;

class TorneoController
{
    public function index()
    {
        $torneos = Torneo::orderBy('nombre')->get();
        return view('torneos.index', compact('torneos'));
    }

    public function index2()
    {
        $torneos = Torneo::orderBy('nombre')->get();
        return view('torneos.index2', compact('torneos'));
    }

}
