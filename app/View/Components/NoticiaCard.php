<?php

namespace App\View\Components;

use App\Models\Noticia;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NoticiaCard extends Component
{
    public Noticia $noticia;
    public function __construct(Noticia $noticia)
    {
        $this->noticia = $noticia;
    }

    public function render(): View|Closure|string
    {
        return view('components.noticia-card');
    }
}
