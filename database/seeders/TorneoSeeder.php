<?php

namespace Database\Seeders;

use App\Models\Equipo;
use App\Models\Torneo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TorneoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $torneo = Torneo::firstOrCreate(
            ['slug' => 'primera-division-2025'],
            [
                'nombre' => 'Liga Playofss',
                'categoria' => 'Primera',
                'temporada' => '2025',
                'descripcion' => 'Torneo oficial de la Liga Chivilcoyana de Fútbol',
                'estado' => 'activo',
                'formato' => 'liga_playoffs',
                'fecha_inicio' => '2025-02-01',
            ]
        );

        $torneo2 = Torneo::firstOrCreate(
            ['slug' => 'segunda-division-2025'],
            [
                'nombre' => 'Liga',
                'categoria' => 'Segunda',
                'temporada' => '2025',
                'descripcion' => 'Torneo oficial de la Liga Chivilcoyana de Fútbol',
                'estado' => 'activo',
                'formato' => 'liga',
                'fecha_inicio' => '2025-02-02',
            ]
        );

        // $torneo3 = Torneo::firstOrCreate(
        //     ['slug' => 'segunda-division-2025'],
        //     [
        //         'nombre' => 'Zonas Playofss',
        //         'categoria' => 'Segunda',
        //         'temporada' => '2025',
        //         'descripcion' => 'Torneo oficial de la Liga Chivilcoyana de Fútbol',
        //         'estado' => 'activo',
        //         'formato' => 'zonas_playoffs',
        //         'fecha_inicio' => '2025-02-02',
        //     ]
        // );
    }
}
