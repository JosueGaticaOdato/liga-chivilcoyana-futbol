<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plantel extends Model
{
  protected $fillable = [
    'dorsal',
    'fecha_incorporacion',
    'fecha_baja',
    'activo'
  ];

  protected $casts = [
    'fecha_incorporacion' => 'date',
    'fecha_baja' => 'date',
    'activo' => 'boolean'
  ];

  public function jugador()
  {
    return $this->belongsTo(Jugador::class);
  }

  public function equipo()
  {
    return $this->belongsTo(Equipo::class);
  }

  public function temporada()
  {
    return $this->belongsTo(Temporada::class);
  }
}
