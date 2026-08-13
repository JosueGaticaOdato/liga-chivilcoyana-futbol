<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Equipo extends Model
{
  protected $fillable = [
    'nombre',
    'activo',
    'club_id',
    'categoria_id',
  ];

  protected $casts = [
    'activo' => 'boolean',
  ];

  // Cada equipo tiene su categoria (pertenece a una categoria)
  public function categoria(): BelongsTo
  {
    return $this->belongsTo(Categoria::class);
  }

  // Cada equipo tiene su club (pertenece a un club)
  public function club(): BelongsTo
  {
    return $this->belongsTo(Club::class);
  }
}
