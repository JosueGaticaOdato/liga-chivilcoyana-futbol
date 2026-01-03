<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    protected $table = 'equipos';

    protected $fillable = [
        'nombre',
        'nombre_pila',
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
}
