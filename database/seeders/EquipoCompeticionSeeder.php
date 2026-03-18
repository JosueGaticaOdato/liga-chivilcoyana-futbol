<?php

namespace Database\Seeders;

use App\Models\Equipo;
use App\Models\EquipoCompeticion;
use App\Models\Fase;
use App\Models\Zona;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EquipoCompeticionSeeder extends Seeder
{

    public function run(): void
    {
        $faseGrupos = Fase::where('nombre', 'Fase de Grupos')->first();

        $zonaA = Zona::where('nombre', 'Zona A')->first();
        $zonaB = Zona::where('nombre', 'Zona B')->first();

        $equipos = Equipo::all();

        foreach ($equipos as $index => $equipo) {

            $zona = $index % 2 === 0 ? $zonaA : $zonaB;

            EquipoCompeticion::firstOrCreate([
                'equipo_id' => $equipo->id,
                'fase_id' => $faseGrupos->id,
                'zona_id' => $zona->id,
            ]);
        }
    }
}
