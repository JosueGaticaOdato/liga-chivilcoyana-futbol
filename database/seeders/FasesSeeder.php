<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Fase;

class FasesSeeder extends Seeder
{
    public function run(): void
    {
        //
        $fases = [
            [
                'torneo_id' => 1,
                'nombre' => 'Liga',
                'tipo' => 'liga',
                'orden' => 1
            ],
            [
                'torneo_id' => 1,
                'nombre' => 'Playoffs',
                'tipo' => 'eliminacion',
                'orden' => 2
            ]
        ];

        foreach ($fases as $fase) {
            Fase::firstOrCreate($fase);
        }
    }
}
