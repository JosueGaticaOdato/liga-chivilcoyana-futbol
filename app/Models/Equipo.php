<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Representa una fila de la tabla equipos
class Equipo extends Model
{
    protected $table = 'equipos';

    protected $fillable = [
        'nombre',
        'nombre_institucional',
        'slug',
        'fecha_creacion',
        'escudo',
        'estadio',
        'descripcion',
        'activo',
    ];

    protected $casts = [
        'fecha_creacion' => 'date',
        'activo' => 'boolean',
    ];

    /** En Laravel, las funciones del modelo NO son lógica de negocio, son: definiciones de relaciones entre tablas
     *  Sirven para que después puedas escribir cosas como
     *  $equipo->torneos
     *  $torneo->equipos
     *  $partido->local->nombre
     */

    // Relaciones
    public function fases()
    {
        return $this->hasMany(EquipoCompeticion::class);
    }

    // //Un equipo participa en muchos torneos
    // public function torneos()
    // {
    //     return $this->belongsToMany(Torneo::class)
    //         //Cuando traigas los torneos de un equipo, traeme también estas columnas de la tabla pivote
    //         ->withPivot([
    //             'partidos_jugados',
    //             'ganados',
    //             'empatados',
    //             'perdidos',
    //             'goles_favor',
    //             'goles_contra',
    //             'diferencia_goles',
    //             'puntos',
    //         ])
    //         ->withTimestamps();
    //     //pivot = fila de equipo_torneo
    // }

    //Un equipo juega muchos partidos como local
    // hasMany: Un partido tiene UN SOLO equipo local, un equipo puede ser local muchas veces
    public function partidosLocal()
    {
        return $this->hasMany(Partido::class, 'equipo_local_id');
    }

    //Un equipo juega muchos partidos como visitante
    // hasMany: Un partido tiene UN SOLO equipo visitante, un equipo puede ser visitante muchas veces
    public function partidosVisitante()
    {
        return $this->hasMany(Partido::class, 'equipo_visitante_id');
    }

    // public function proximoPartido(Torneo $torneo)
    // {
    //     return Partido::where('torneo_id', $torneo->id)
    //         ->where('estado', 'programado')
    //         ->where(function ($query) {
    //             $query->where('equipo_local_id', $this->id)
    //                 ->orWhere('equipo_visitante_id', $this->id);
    //         })
    //         ->whereDate('fecha', '>=', now()->toDateString())
    //         ->orderBy('fecha')
    //         ->orderBy('hora')
    //         ->first();
    // }
}
