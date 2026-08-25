<?php

namespace App\Http\Controllers;

use App\Models\Club;
use Illuminate\Http\Request;

class ClubController
{
    //
    public function index()
    {
        $clubes = Club::orderBy('nombre')->get();
        return view('clubes.index', compact('clubes'));
    }

    public function index2()
    {
        $clubes = Club::orderBy('nombre')->get();
        return view('clubes.index2', compact('clubes'));
    }

    public function show(Club $equipo)
    {
        return view('clubes.show', compact('equipo'));
    }
}
