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
        'estado',
        'fecha_inicio',
        'fecha_fin',
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
    ];

    public function equipos()
    {
        return $this->belongsToMany(Equipo::class)
            ->withPivot([
                'partidos_jugados',
                'ganados',
                'empatados',
                'perdidos',
                'goles_favor',
                'goles_contra',
                'diferencia_goles',
                'puntos',
            ])
            ->withTimestamps();
    }

    //Un torneo tiene muchos partidos
    public function partidos()
    {
        return $this->hasMany(Partido::class);
    }

    public function fases()
    {
        return $this->hasMany(Fase::class);
    }

    public function fechas()
    {
        return $this->hasManyThrough(
            Fecha::class,
            Fase::class
        );
    }
}
