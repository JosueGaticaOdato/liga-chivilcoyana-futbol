<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Torneo extends Model
{
  protected $fillable = [
    'nombre',
    'temporada_id',
    'categoria_id',
    'slug',
    'fecha_inicio',
    'fecha_fin',
    'estado'
  ];

  protected $casts = [
    'fecha_inicio' => 'date',
    'fecha_fin' => 'date'
  ];

  public function temporada()
  {
    return $this->belongsTo(Temporada::class);
  }

  public function partidos()
  {
    return $this->hasMany(Partido::class);
  }

  public function categoria()
  {
    return $this->belongsTo(Categoria::class);
  }

  public function fases()
  {
    return $this->hasMany(Fase::class);
  }
}
