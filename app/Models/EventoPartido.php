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

  public function partido()
  {
    return $this->belongsTo(Partido::class);
  }

  public function equipo()
  {
    return $this->belongsTo(Equipo::class);
  }

  public function jugador()
  {
    return $this->belongsTo(Jugador::class);
  }
}
