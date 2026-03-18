<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Torneo extends Model
{
    protected $fillable = [
        'nombre',
        'slug',
        'categoria',
        'temporada',
        'descripcion',
        'formato',
        'estado',
        'fecha_inicio',
        'fecha_fin'
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
    ];

    // Relaciones
    public function fases()
    {
        return $this->hasMany(Fase::class);
    }

    public function partidos()
    {
        return $this->hasMany(Partido::class);
    }
}
