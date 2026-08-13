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
}
