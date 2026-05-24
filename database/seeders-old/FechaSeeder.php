<?php

namespace Database\Seeders;

use App\Models\Fase;
use App\Models\Fecha;
use App\Models\Torneo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FechaSeeder extends Seeder
{
    public function run(): void
    {
        $faseGrupos = Fase::where('nombre', 'Fase de Grupos')->first();
        $fasePlayoffs = Fase::where('nombre', 'Playoffs')->first();

        $fechas = [
            [
                'numero' => 1,
                'fase_id' => $faseGrupos->id,
                'nombre' => 'Fecha 1'
            ],
            [
                'numero' => 2,
                'fase_id' => $faseGrupos->id,
                'nombre' => 'Fecha 2'
            ],
            [
                'numero' => 3,
                'fase_id' => $faseGrupos->id,
                'nombre' => 'Fecha 3'
            ],
            [
                'numero' => 4,
                'fase_id' => $faseGrupos->id,
                'nombre' => 'Fecha 4'
            ],
            [
                'numero' => 5,
                'fase_id' => $faseGrupos->id,
                'nombre' => 'Fecha 5'
            ],
            [
                'numero' => 6,
                'fase_id' => $faseGrupos->id,
                'nombre' => 'Fecha 6'
            ],
            [
                'numero' => 7,
                'fase_id' => $faseGrupos->id,
                'nombre' => 'Fecha 7'
            ],
            [
                'numero' => 1,
                'fase_id' => $fasePlayoffs->id,
                'nombre' => 'Final'
            ]
        ];

        foreach ($fechas as $data) {
            Fecha::firstOrCreate(
                $data
            );
        }
    }
}
