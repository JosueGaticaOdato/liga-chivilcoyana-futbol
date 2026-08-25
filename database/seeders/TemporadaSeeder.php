<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Temporada;

class TemporadaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $temporadas = [
            [
                'nombre' => '2026',
                'fecha_inicio' => '2026-01-01',
                'fecha_fin' => '2026-12-31'
            ],
        ];

        foreach ($temporadas as $temporada) {
            Temporada::create($temporada);
        }
    }
}
