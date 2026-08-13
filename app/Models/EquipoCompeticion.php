<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EquipoCompeticion extends Model
{
  protected $fillable = [
    'estado',
    'sembrado',
    'partidos_jugados',
    'ganados',
    'empatados',
    'perdidos',
    'goles_favor',
    'goles_contra',
    'diferencia_goles',
    'puntos',
    'puntos_deducidos',
  ];

}
