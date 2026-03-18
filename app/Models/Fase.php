<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fase extends Model
{
    protected $fillable = [
        'torneo_id',
        'nombre',
        'orden',
        'tipo'
    ];

    // Relaciones
    public function torneo()
    {
        return $this->belongsTo(Torneo::class);
    }

    public function zonas()
    {
        return $this->hasMany(Zona::class);
    }

    public function fechas()
    {
        return $this->hasMany(Fecha::class);
    }

    public function partidos()
    {
        return $this->hasMany(Partido::class);
    }

    public function equipos()
    {
        return $this->hasMany(EquipoCompeticion::class);
    }
}
