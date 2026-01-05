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
                'nombre' => 'Primera División',
                'categoria' => 'Primera',
                'temporada' => '2025',
                'descripcion' => 'Torneo oficial de la Liga Chivilcoyana de Fútbol',
                'estado' => 'activo',
                'fecha_inicio' => '2025-02-01',
            ]
        );

        $torneo2 = Torneo::firstOrCreate(
            ['slug' => 'segunda-division-2025'],
            [
                'nombre' => 'Segunda División',
                'categoria' => 'Segunda',
                'temporada' => '2025',
                'descripcion' => 'Torneo oficial de la Liga Chivilcoyana de Fútbol',
                'estado' => 'activo',
                'fecha_inicio' => '2025-02-02',
            ]
        );

        // Obtener todos los equipos
        $equipos = Equipo::all();

        foreach ($equipos as $equipo) {
            $torneo->equipos()->syncWithoutDetaching([
                $equipo->id => [
                    'partidos_jugados' => 0,
                    'ganados' => 0,
                    'empatados' => 0,
                    'perdidos' => 0,
                    'goles_favor' => 0,
                    'goles_contra' => 0,
                    'diferencia_goles' => 0,
                    'puntos' => 0,
                ]
            ]);
            $torneo2->equipos()->syncWithoutDetaching([
                $equipo->id => [
                    'partidos_jugados' => 1,
                    'ganados' => 1,
                    'empatados' => 1,
                    'perdidos' => 1,
                    'goles_favor' => 1,
                    'goles_contra' => 1,
                    'diferencia_goles' => 1,
                    'puntos' => 1,
                ]
            ]);
        }
    }
}
