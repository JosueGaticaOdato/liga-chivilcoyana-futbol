<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fase extends Model
{
    protected $fillable = [
        'torneo_id',
        'nombre',
        'tipo',
        'orden'
    ];

    public function torneo()
    {
        return $this->belongsTo(Torneo::class);
    }

    public function fechas()
    {
        return $this->hasMany(Fecha::class);
    }
}
