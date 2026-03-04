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
                $data
            );
        }
    }
}
