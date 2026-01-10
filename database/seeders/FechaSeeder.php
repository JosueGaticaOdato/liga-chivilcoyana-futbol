<?php

namespace Database\Seeders;

use App\Models\Fecha;
use App\Models\Torneo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FechaSeeder extends Seeder
{
    public function run(): void
    {
        // $torneo = Torneo::where('slug', 'primera-division-2025')->first();
        $torneo = Torneo::first(); // o buscá por nombre/slug

        if (!$torneo) {
            $this->command->warn('No hay torneo creado');
            return;
        }

        $fechas = [
            [
                'numero' => 1,
                'nombre' => 'Fecha 1'
            ],
            [
                'numero' => 2,
                'nombre' => 'Fecha 2'
            ],
        ];

        foreach ($fechas as $data) {
            Fecha::firstOrCreate(
                [
                    'torneo_id' => $torneo->id,
                    'numero' => $data['numero'],
                ],
                $data
            );
        }
    }
}
