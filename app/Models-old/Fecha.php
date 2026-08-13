<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fecha extends Model
{
    protected $fillable = [
        'torneo_id',
        'numero',
        'nombre'
    ];

    public function partidos()
    {
        return $this->hasMany(Partido::class);
    }

    public function fase()
    {
        return $this->belongsTo(Fase::class);
    }
}
