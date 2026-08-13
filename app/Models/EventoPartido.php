<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventoPartido extends Model
{
  protected $fillable = [
    'partido_id',
    'equipo_id',
    'jugador_id',
    'tipo_evento',
    'minuto',
    'detalle',
  ];
}
