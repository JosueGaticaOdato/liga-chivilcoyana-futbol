<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Temporada extends Model
{
  protected $fillable = [
    'nombre',
    'fecha_inicio',
    'fecha_fin',
    'activa'
  ];

  protected $casts = [
    'fecha_inicio' => 'date',
    'fecha_fin' => 'date',
    'activa' => 'boolean',
  ];

  public function torneos()
  {
    return $this->hasMany(Torneo::class);
  }

  public function planteles()
  {
    return $this->hasMany(Plantel::class);
  }
}
