<?php

namespace App\Services;

use App\Models\EquipoCompeticion;
use App\Models\Fase;
use App\Models\Torneo;
use App\Models\Partido;

// Servicio encargado de recalcular los puntos del torneo en base a los partidos, para no tocar esto a mano
class TablaPosicionesService
{
    public function recalcular(Fase $fase): void
    {
        // Resetear stats
        EquipoCompeticion::where('fase_id', $fase->id)->update([
            'partidos_jugados' => 0,
            'ganados' => 0,
            'empatados' => 0,
            'perdidos' => 0,
            'goles_favor' => 0,
            'goles_contra' => 0,
            'diferencia_goles' => 0,
            'puntos' => 0,
        ]);

        // Obtener partidos finalizados
        $partidos = Partido::where('fase_id', $fase->id)
            ->where('estado', 'finalizado')
            ->get();


        foreach ($partidos as $partido) {

            // LOCAL
            $this->procesarEquipo(
                $fase->id,
                $partido->zona_id,
                $partido->equipo_local_id,
                $partido->goles_local,
                $partido->goles_visitante
            );

            // VISITANTE
            $this->procesarEquipo(
                $fase->id,
                $partido->zona_id,
                $partido->equipo_visitante_id,
                $partido->goles_visitante,
                $partido->goles_local
            );
        }
    }

    private function procesarEquipo(
        int $faseId,
        ?int $zonaId,
        int $equipoId,
        int $golesFavor,
        int $golesContra
    ): void {
        $equipoFase = EquipoCompeticion::where('fase_id', $faseId)
            ->where('equipo_id', $equipoId)
            ->where('zona_id', $zonaId)
            ->first();

        if (!$equipoFase) {
            return;
        }

        $ganado = $golesFavor > $golesContra;
        $empatado = $golesFavor === $golesContra;

        $equipoFase->partidos_jugados += 1;
        $equipoFase->goles_favor += $golesFavor;
        $equipoFase->goles_contra += $golesContra;
        $equipoFase->diferencia_goles =
            $equipoFase->goles_favor - $equipoFase->goles_contra;

        if ($ganado) {
            $equipoFase->ganados += 1;
            $equipoFase->puntos += 3;
        } elseif ($empatado) {
            $equipoFase->empatados += 1;
            $equipoFase->puntos += 1;
        } else {
            $equipoFase->perdidos += 1;
        }

        $equipoFase->save();
    }
}
