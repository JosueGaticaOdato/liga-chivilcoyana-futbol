<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categoria extends Model
{
  protected $fillable = [
    'nombre',
    'orden'
  ];

  // Un categoria tiene muchos equipos
  public function Equipos(): HasMany
  {
    return $this->hasMany(Equipo::class);
  }

  public function Torneos(): HasMany
  {
    return $this->hasMany(Torneo::class);
  }
}
