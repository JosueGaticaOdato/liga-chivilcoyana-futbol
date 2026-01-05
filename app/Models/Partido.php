<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partido extends Model
{
    protected $fillable = [
        'torneo_id',
        'fecha',
        'hora',
        'equipo_local_id',
        'equipo_visitante_id',
        'goles_local',
        'goles_visitante',
        'estado',
        'cancha',
    ];

    //Un partido pertenece a un torneo
    public function torneo()
    {
        return $this->belongsTo(Torneo::class);
    }

    //Este partido tiene un equipo local
    public function local()
    {
        return $this->belongsTo(Equipo::class, 'equipo_local_id');
    }

    //Este partido tiene un equipo visitante
    public function visitante()
    {
        return $this->belongsTo(Equipo::class, 'equipo_visitante_id');
    }
}
