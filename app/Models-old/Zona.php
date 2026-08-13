<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zona extends Model
{

    protected $fillable = [
        'fase_id',
        'nombre'
    ];

    // Relaciones
    public function fase()
    {
        return $this->belongsTo(Fase::class);
    }

    public function equipos()
    {
        return $this->hasMany(EquipoCompeticion::class);
    }

    public function partidos()
    {
        return $this->hasMany(Partido::class);
    }
}
