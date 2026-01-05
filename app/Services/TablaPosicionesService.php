<?php

namespace App\Services;

use App\Models\Torneo;
use App\Models\Partido;

// Servicio encargado de recalcular los puntos del torneo en base a los partidos, para no tocar esto a mano
class TablaPosicionesService
{
    public function recalcular(Torneo $torneo): void
    {
        // Resetear stats
        foreach ($torneo->equipos as $equipo) {
            $torneo->equipos()->updateExistingPivot($equipo->id, [
                'partidos_jugados' => 0,
                'ganados' => 0,
                'empatados' => 0,
                'perdidos' => 0,
                'goles_favor' => 0,
                'goles_contra' => 0,
                'diferencia_goles' => 0,
                'puntos' => 0,
            ]);
        }

        // Obtener partidos finalizados
        $partidos = Partido::where('torneo_id', $torneo->id)
            ->where('estado', 'finalizado')
            ->get();

        foreach ($partidos as $partido) {

            $this->procesarEquipo(
                $torneo,
                $partido->equipo_local_id,
                $partido->goles_local,
                $partido->goles_visitante
            );

            $this->procesarEquipo(
                $torneo,
                $partido->equipo_visitante_id,
                $partido->goles_visitante,
                $partido->goles_local
            );
        }
    }

    private function procesarEquipo(
        Torneo $torneo,
        int $equipoId,
        int $golesFavor,
        int $golesContra
    ): void {
        $pivot = $torneo->equipos()->where('equipo_id', $equipoId)->first()->pivot;

        $ganado = $golesFavor > $golesContra;
        $empatado = $golesFavor === $golesContra;

        $pivot->partidos_jugados += 1;
        $pivot->goles_favor += $golesFavor;
        $pivot->goles_contra += $golesContra;
        $pivot->diferencia_goles = $pivot->goles_favor - $pivot->goles_contra;

        if ($ganado) {
            $pivot->ganados += 1;
            $pivot->puntos += 3;
        } elseif ($empatado) {
            $pivot->empatados += 1;
            $pivot->puntos += 1;
        } else {
            $pivot->perdidos += 1;
        }

        $pivot->save();
    }
}
