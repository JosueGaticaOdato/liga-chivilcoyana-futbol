<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jugador extends Model
{
  protected $fillable = [
    'nombre',
    'apellido',
    'fecha_nacimiento',
    'nacionalidad',
    'posicion_principal',
    'foto'
  ];

  protected $casts = [
    'fecha_nacimiento' => 'date'
  ];
}
