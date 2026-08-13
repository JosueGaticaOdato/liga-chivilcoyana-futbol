<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Partido extends Model
{
    protected $fillable = [
        'torneo_id',
        'fase_id',
        'fecha_id',
        'zona_id',
        'fecha_partido',
        'hora_partido',
        'equipo_local_id',
        'equipo_visitante_id',
        'goles_local',
        'goles_visitante',
        'estado',
        'estadio_id',
    ];

    // Relaciones

    //Un partido pertenece a un torneo
    public function torneo()
    {
        return $this->belongsTo(Torneo::class);
    }

    public function fase()
    {
        return $this->belongsTo(Fase::class);
    }
    public function fecha()
    {
        return $this->belongsTo(Fecha::class);
    }

    public function zona()
    {
        return $this->belongsTo(Zona::class);
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

    public function estadio()
    {
        return $this->belongsTo(Estadio::class);
    }

    // Casteo fecha y hora
    protected $casts = [
        'fecha_partido' => 'date'
    ];

    public function getFechaHoraAttribute(): Carbon
    {
        if (!$this->hora) {
            return $this->fecha_partido;
        }

        return Carbon::createFromFormat(
            'Y-m-d H:i:s',
            $this->fecha_partido->format('Y-m-d') . ' ' . $this->hora_partido
        );
    }

    public function getFechaHoraFormateadaAttribute(): string
    {
        return strtoupper(
            $this->fecha_hora->translatedFormat('D d M | H:i')
        );
    }

}
