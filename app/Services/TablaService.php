<?php

namespace App\Services;

use App\Models\EquipoCompeticion;

class TablaService
{
    public function getTabla($torneo, $fases)
    {
        // Fase de grupos (si tiene)
        $faseGrupos = $fases->firstWhere('tipo', 'liga');

        $tablas = collect();

        if ($faseGrupos) {
            // Caso con zonas
            if ($faseGrupos->zonas->count() > 0) {

                foreach ($faseGrupos->zonas as $zona) {

                    $tabla = EquipoCompeticion::where('fase_id', $faseGrupos->id)
                        ->where('zona_id', $zona->id)
                        ->orderByDesc('puntos')
                        ->orderByDesc('diferencia_goles')
                        ->orderByDesc('goles_favor')
                        ->with('equipo')
                        ->get();

                    $tablas->push([
                        'zona' => $zona,
                        'tabla' => $tabla
                    ]);
                }
            } else {
                // Liga simple (sin zonas)
                $tabla = EquipoCompeticion::where('fase_id', $faseGrupos->id)
                    ->whereNull('zona_id')
                    ->orderByDesc('puntos')
                    ->orderByDesc('diferencia_goles')
                    ->orderByDesc('goles_favor')
                    ->with('equipo')
                    ->get();

                $tablas->push([
                    'zona' => null,
                    'tabla' => $tabla
                ]);
            }
        }

        return $tablas;
    }
}
