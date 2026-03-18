<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EquipoCompeticion extends Model
{
    protected $table = 'equipo_competicion';

    protected $fillable = [
        'equipo_id',
        'fase_id',
        'zona_id',
        'partidos_jugados',
        'ganados',
        'empatados',
        'perdidos',
        'goles_favor',
        'goles_contra',
        'diferencia_goles',
        'puntos'
    ];

    // Relaciones
    public function equipo()
    {
        return $this->belongsTo(Equipo::class);
    }

    public function fase()
    {
        return $this->belongsTo(Fase::class);
    }

    public function zona()
    {
        return $this->belongsTo(Zona::class);
    }
}
