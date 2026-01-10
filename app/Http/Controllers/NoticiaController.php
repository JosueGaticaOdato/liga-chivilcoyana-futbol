<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use Illuminate\Http\Request;

class NoticiaController extends Controller
{
    public function index()
    {
        $noticias = Noticia::whereNotNull('fecha_publicacion')
            ->orderByDesc('fecha_publicacion')
            ->get();

        return view('noticias.index', compact('noticias'));
    }

    public function show(Noticia $noticia)
    {
        // Incrementar visita
        $noticia->increment('visitas');

        return view('noticias.show', compact('noticia'));
    }

    // Noticia destacada para el home
    public function destacadas(int $limit = 3)
    {
        return Noticia::whereNotNull('fecha_publicacion')
            ->orderByDesc('fecha_publicacion')
            ->limit($limit)
            ->get();
    }
}
