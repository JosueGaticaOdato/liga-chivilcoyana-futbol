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

    public function show(Club $club)
    {
        return view('clubes.show', compact('club'));
    }

    public function show2(Club $club)
    {
        return view('clubes.show2', compact('club'));
    }
}
