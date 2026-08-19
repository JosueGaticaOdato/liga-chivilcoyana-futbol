<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fase extends Model
{
  protected $fillable = [
    'nombre',
    'orden',
    'tipo',
  ];

  public function torneos()
  {
    return $this->belongsTo(Torneo::class);
  }

  public function partidos()
  {
    return $this->hasMany(Partido::class);
  }

  public function zonas()
  {
    return $this->hasMany(Zona::class);
  }
}
