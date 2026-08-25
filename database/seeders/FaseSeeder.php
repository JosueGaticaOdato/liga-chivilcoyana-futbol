<?php

namespace Database\Seeders;

use App\Models\Torneo;
use App\Models\Fase;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $torneoClausura = Torneo::where('nombre', 'Clausura')->first();

        if (!$torneoClausura) {
            $this->command->error('No se pudo encontrar el torneo Clausura.');
            return;
        }

        $fases = [
            [
                'nombre' => 'Todos contra todos',
                'orden' => 1,
                'tipo' => 'round_robin',
            ],
            [
                'nombre' => 'Play-offs',
                'orden' => 2,
                'tipo' => 'eliminacion_ida_vuelta',
            ],
        ];

        foreach ($fases as $fase) {
            Fase::updateOrCreate(
                [
                    'torneo_id' => $torneoClausura->id,
                    'nombre' => $fase['nombre'],
                ],
                [
                    'orden' => $fase['orden'],
                    'tipo' => $fase['tipo'],
                ]
            );
        }
    }
}


