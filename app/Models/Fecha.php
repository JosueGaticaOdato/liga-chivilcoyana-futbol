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

    public function torneo()
    {
        return $this->belongsTo(Torneo::class);
    }

    public function partidos()
    {
        return $this->hasMany(Partido::class);
    }
}
