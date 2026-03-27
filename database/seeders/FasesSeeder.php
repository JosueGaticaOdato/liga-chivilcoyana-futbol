<?php

namespace Database\Seeders;

use App\Models\Torneo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Fase;

class FasesSeeder extends Seeder
{
    public function run(): void
    {
        //
        $torneo1 = Torneo::where('slug', 'apertura-2026')->first();
        $torneo2 = Torneo::where('slug', 'segunda-division-2025')->first();

        $fases = [
            [
                'torneo_id' => $torneo1->id,
                'nombre' => 'Fase de Grupos',
                'tipo' => 'liga',
                'orden' => 1
            ],
            [
                'torneo_id' => $torneo1->id,
                'nombre' => 'Playoffs',
                'tipo' => 'eliminacion',
                'orden' => 2
            ],
            [
                'torneo_id' => $torneo2->id,
                'nombre' => 'Liga',
                'tipo' => 'liga',
                'orden' => 1
            ],
        ];

        foreach ($fases as $fase) {
            Fase::firstOrCreate($fase);
        }
    }
}
