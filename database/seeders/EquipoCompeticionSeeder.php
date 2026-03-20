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

        // Zona actual liga chivilcoyana

        // Zona A: Indeependiente, Gimnasia, Varela, San Lorenzo, Moquehua, Ceramica
        EquipoCompeticion::firstOrCreate([
            'equipo_id' => Equipo::where('nombre', 'Independiente')->first()->id,
            'fase_id' => $faseGrupos->id,
            'zona_id' => $zonaA->id,
        ]);
        EquipoCompeticion::firstOrCreate([
            'equipo_id' => Equipo::where('nombre', 'Gimnasia')->first()->id,
            'fase_id' => $faseGrupos->id,
            'zona_id' => $zonaA->id,
        ]);
        EquipoCompeticion::firstOrCreate([
            'equipo_id' => Equipo::where('nombre', 'Varela')->first()->id,
            'fase_id' => $faseGrupos->id,
            'zona_id' => $zonaA->id,
        ]);
        EquipoCompeticion::firstOrCreate([
            'equipo_id' => Equipo::where('nombre', 'San Lorenzo')->first()->id,
            'fase_id' => $faseGrupos->id,
            'zona_id' => $zonaA->id,
        ]);
        EquipoCompeticion::firstOrCreate([
            'equipo_id' => Equipo::where('nombre', 'Moquehua')->first()->id,
            'fase_id' => $faseGrupos->id,
            'zona_id' => $zonaA->id,
        ]);
        EquipoCompeticion::firstOrCreate([
            'equipo_id' => Equipo::where('nombre', 'Ceramica')->first()->id,
            'fase_id' => $faseGrupos->id,
            'zona_id' => $zonaA->id,
        ]);


        // Zona B: Villarino, Huracan, Once Tigres, Alsina, Pellegrini, Colon, 22 de octubre
        EquipoCompeticion::firstOrCreate([
            'equipo_id' => Equipo::where('nombre', 'Villarino')->first()->id,
            'fase_id' => $faseGrupos->id,
            'zona_id' => $zonaB->id,
        ]);
        EquipoCompeticion::firstOrCreate([
            'equipo_id' => Equipo::where('nombre', 'Huracan')->first()->id,
            'fase_id' => $faseGrupos->id,
            'zona_id' => $zonaB->id,
        ]);
        EquipoCompeticion::firstOrCreate([
            'equipo_id' => Equipo::where('nombre', 'Once Tigres')->first()->id,
            'fase_id' => $faseGrupos->id,
            'zona_id' => $zonaB->id,
        ]);
        EquipoCompeticion::firstOrCreate([
            'equipo_id' => Equipo::where('nombre', 'Alsina')->first()->id,
            'fase_id' => $faseGrupos->id,
            'zona_id' => $zonaB->id,
        ]);
        EquipoCompeticion::firstOrCreate([
            'equipo_id' => Equipo::where('nombre', 'Pellegrini')->first()->id,
            'fase_id' => $faseGrupos->id,
            'zona_id' => $zonaB->id,
        ]);
        EquipoCompeticion::firstOrCreate([
            'equipo_id' => Equipo::where('nombre', 'Colon')->first()->id,
            'fase_id' => $faseGrupos->id,
            'zona_id' => $zonaB->id,
        ]);
        EquipoCompeticion::firstOrCreate([
            'equipo_id' => Equipo::where('nombre', '22 de Octubre')->first()->id,
            'fase_id' => $faseGrupos->id,
            'zona_id' => $zonaB->id,
        ]);

        // foreach ($equipos as $index => $equipo) {

        //     $zona = $index % 2 === 0 ? $zonaA : $zonaB;

        //     EquipoCompeticion::firstOrCreate([
        //         'equipo_id' => $equipo->id,
        //         'fase_id' => $faseGrupos->id,
        //         'zona_id' => $zona->id,
        //     ]);
        // }
    }
}
