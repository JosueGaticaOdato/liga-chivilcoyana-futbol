<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Estadio extends Model
{
  protected $fillable = [
    'nombre',
    'direccion',
    'latitud',
    'longitud',
    'capacidad'
  ];

  public function clubes(): HasMany
  {
    return $this->hasMany(Club::class);
  }

  public function partidos(): HasMany
  {
    return $this->hasMany(Partido::class);
  }
}
