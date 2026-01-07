<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class TablaPosiciones extends Component
{
    public Collection $equipos;
    public ?int $limit;

    public ?string $variant;

    public function __construct(Collection $equipos, int $limit = null, string $variant = 'full')
    {
        $this->equipos = $limit
            ? $equipos->take($limit)
            : $equipos;

        $this->limit = $limit;
        $this->variant = $variant;
    }

    public function render()
    {
        return view('components.tabla-posiciones');
    }
}
