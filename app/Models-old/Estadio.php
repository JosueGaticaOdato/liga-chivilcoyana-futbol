<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estadio extends Model
{
    protected $fillable = [
        'nombre',
        'latitud',
        'longitud'
    ];
}
