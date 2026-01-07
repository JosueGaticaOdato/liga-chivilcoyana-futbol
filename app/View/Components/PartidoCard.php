<?php

namespace App\View\Components;

use App\Models\Partido;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PartidoCard extends Component
{
    public Partido $partido;

    public function __construct(Partido $partido)
    {
        $this->partido = $partido;
    }

    public function render()
    {
        return view('components.partido-card');
    }
}
