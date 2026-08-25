<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EquipoCompeticion extends Model
{
  protected $table = 'equipo_competicion';

  protected $fillable = [
    'zona_id',
    'equipo_id',
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

  public function zona()
  {
    return $this->belongsTo(Zona::class);
  }

  public function equipo()
  {
    return $this->belongsTo(Equipo::class);
  }

}
