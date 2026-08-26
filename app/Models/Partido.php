<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partido extends Model
{
  protected $fillable = [
    'jornada',
    'llave',
    'fecha_hora',
    'estado',
    'goles_local',
    'goles_visitante',
    'goles_local_penales',
    'goles_visitante_penales',
  ];

  protected $casts = [
    'fecha_hora' => 'datetime',
  ];

  public function fase()
  {
    return $this->belongsTo(Fase::class);
  }

  public function zona()
  {
    return $this->belongsTo(Zona::class);
  }

  public function local()
  {
    return $this->belongsTo(Equipo::class, 'equipo_local_id');
  }

  public function visitante()
  {
    return $this->belongsTo(Equipo::class, 'equipo_visitante_id');
  }

  public function torneo()
  {
    return $this->belongsTo(Torneo::class);
  }

  public function estadio()
  {
    return $this->belongsTo(Estadio::class);
  }

  public function eventoPartidos()
  {
    return $this->hasMany(EventoPartido::class);
  }
}
