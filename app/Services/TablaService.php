<?php

namespace App\Services;

use App\Models\EquipoCompeticion;
use App\Models\Fase;
use App\Models\Partido;

class TablaService
{
    public function getTabla($torneo, $fases)
    {
        $faseGrupos = $fases->firstWhere('tipo', 'round_robin');

        $tablas = collect();

        if ($faseGrupos) {
            if ($faseGrupos->zonas->count() > 0) {
                foreach ($faseGrupos->zonas as $zona) {
                    $tabla = EquipoCompeticion::where('zona_id', $zona->id)
                        ->orderByDesc('puntos')
                        ->orderByDesc('diferencia_goles')
                        ->orderByDesc('goles_favor')
                        ->with('equipo.club')
                        ->get();

                    $tablas->push([
                        'zona' => $zona,
                        'tabla' => $tabla
                    ]);
                }
            } else {
                $tabla = EquipoCompeticion::whereNull('zona_id')
                    ->orderByDesc('puntos')
                    ->orderByDesc('diferencia_goles')
                    ->orderByDesc('goles_favor')
                    ->with('equipo.club')
                    ->get();

                $tablas->push([
                    'zona' => null,
                    'tabla' => $tabla
                ]);
            }
        }

        return $tablas;
    }

    public function recalcular(Fase $fase): void
    {
        // Solo recalcular tabla en fases tipo round_robin (liga/grupos)
        if ($fase->tipo !== 'round_robin') {
            return;
        }

        $zonaIds = $fase->zonas->pluck('id')->toArray();

        // Resetear estadísticas para las zonas de esta fase
        EquipoCompeticion::whereIn('zona_id', $zonaIds)->update([
            'partidos_jugados' => 0,
            'ganados' => 0,
            'empatados' => 0,
            'perdidos' => 0,
            'goles_favor' => 0,
            'goles_contra' => 0,
            'diferencia_goles' => 0,
            'puntos' => 0,
        ]);

        // Obtener todos los partidos finalizados de esta fase
        $partidos = Partido::where('fase_id', $fase->id)
            ->where('estado', 'finalizado')
            ->get();

        foreach ($partidos as $partido) {
            // Procesar equipo LOCAL
            $this->procesarEquipo(
                $partido->zona_id,
                $partido->equipo_local_id,
                (int) $partido->goles_local,
                (int) $partido->goles_visitante
            );

            // Procesar equipo VISITANTE
            $this->procesarEquipo(
                $partido->zona_id,
                $partido->equipo_visitante_id,
                (int) $partido->goles_visitante,
                (int) $partido->goles_local
            );
        }
    }

    private function procesarEquipo(?int $zonaId, int $equipoId, int $golesFavor, int $golesContra): void
    {
        if (!$zonaId) {
            return;
        }

        $equipoFase = EquipoCompeticion::firstOrCreate(
            [
                'zona_id' => $zonaId,
                'equipo_id' => $equipoId,
            ],
            [
                'partidos_jugados' => 0,
                'ganados' => 0,
                'empatados' => 0,
                'perdidos' => 0,
                'goles_favor' => 0,
                'goles_contra' => 0,
                'diferencia_goles' => 0,
                'puntos' => 0,
            ]
        );

        $ganado = $golesFavor > $golesContra;
        $empatado = $golesFavor === $golesContra;

        $equipoFase->partidos_jugados += 1;
        $equipoFase->goles_favor += $golesFavor;
        $equipoFase->goles_contra += $golesContra;
        $equipoFase->diferencia_goles = $equipoFase->goles_favor - $equipoFase->goles_contra;

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
