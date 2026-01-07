<?php

namespace App\Models;

use Carbon\Carbon;
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

    // Casteo fecha y hora
    protected $casts = [
        'fecha' => 'date'
    ];

    public function getFechaHoraAttribute(): Carbon
    {
        if (!$this->hora) {
            return $this->fecha;
        }

        return Carbon::createFromFormat(
            'Y-m-d H:i:s',
            $this->fecha->format('Y-m-d') . ' ' . $this->hora
        );
    }

    public function getFechaHoraFormateadaAttribute(): string
    {
        return strtoupper(
            $this->fecha_hora->translatedFormat('D d M | H:i')
        );
    }
}
