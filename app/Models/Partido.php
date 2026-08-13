<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partido extends Model
{
  protected $fillable = [
    'jornada',
    'llave',
    'fecha_hora',
    'estado',
    'goles_local',
    'goles_visitante',
    'goles_local_penales',
    'goles_visitante_penales',
  ];

  protected $casts = [
    'fecha_hora' => 'datetime',
  ];
}
