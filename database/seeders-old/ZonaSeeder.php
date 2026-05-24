<?php

namespace Database\Seeders;

use App\Models\Fase;
use App\Models\Zona;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ZonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faseGrupos = Fase::where('nombre', 'Fase de Grupos')->first();
        $faseLiga = Fase::where('nombre', 'Liga')->first();

        // Torneo con zonas
        Zona::firstOrCreate([
            'fase_id' => $faseGrupos->id,
            'nombre' => 'Zona A'
        ]);

        Zona::firstOrCreate([
            'fase_id' => $faseGrupos->id,
            'nombre' => 'Zona B'
        ]);

        // Torneo sin zonas → zona única
        Zona::firstOrCreate([
            'fase_id' => $faseLiga->id,
            'nombre' => 'General'
        ]);

    }
}
