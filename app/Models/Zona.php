<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zona extends Model
{
  protected $fillable = [
    'nombre'
  ];

  public function fase()
  {
    return $this->belongsTo(Fase::class);
  }

  public function partidos()
  {
    return $this->hasMany(Partido::class);
  }

  public function equipoCompeticion()
  {
    return $this->hasMany(EquipoCompeticion::class);
  }
}
