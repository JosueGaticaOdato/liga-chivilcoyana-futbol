<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Equipo;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class EquipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $equipos = [
            [
                'nombre' => 'Club Atletico Independiente',
                'nombre_pila' => 'Independiente',
                'escudo' => 'Independiente.png',
                'fecha_creacion' => '1930-04-05',
                'estadio' => 'Estadio Raul Orlando Lungarzo',
                'descripcion' => 'Descripcion',
            ],
            [
                'nombre' => 'Club Social, Cultural y Deportivo Gimnasia y Esgrima',
                'nombre_pila' => 'Gimnasia',
                'escudo' => 'Gimnasia.png',
                'fecha_creacion' => '1916-04-18',
                'estadio' => 'Estadio José María Paz',
                'descripcion' => 'Descripcion',
            ],
            [
                'nombre' => 'Club Social y Deportivo 22 de Octubre',
                'nombre_pila' => '22 de Octubre',
                'escudo' => '22Octubre.png',
                'fecha_creacion' => '1900-01-01',
                'estadio' => 'Estadio X',
                'descripcion' => 'Descripcion',
            ],
            [
                'nombre' => 'Club Deportivo Alsina',
                'nombre_pila' => 'Alsina',
                'escudo' => 'Alsina.png',
                'fecha_creacion' => '1900-01-01',
                'estadio' => 'Estadio Alsina',
                'descripcion' => 'Descripcion',
            ],
            [
                'nombre' => 'Club Social y Deportivo Ceramica Argentina',
                'nombre_pila' => 'Ceramica',
                'escudo' => 'Ceramica.png',
                'fecha_creacion' => '1900-01-01',
                'estadio' => 'Estadio Ceramica',
                'descripcion' => 'Descripcion',
            ],
            [
                'nombre' => 'Club Atletico Ciclon',
                'nombre_pila' => 'Ciclon',
                'escudo' => 'Ciclon.png',
                'fecha_creacion' => '1900-01-01',
                'estadio' => 'Estadio Ciclon',
                'descripcion' => 'Descripcion',
            ],
            [
                'nombre' => 'Club Social y Deportivo Colon',
                'nombre_pila' => 'Colon',
                'escudo' => 'Colon.png',
                'fecha_creacion' => '1900-01-01',
                'estadio' => 'Estadio Colon',
                'descripcion' => 'Descripcion',
            ],
            [
                'nombre' => 'Club Social y Deportivo Huracan',
                'nombre_pila' => 'Huracan',
                'escudo' => 'Huracan.png',
                'fecha_creacion' => '1900-01-01',
                'estadio' => 'Estadio Huracan',
                'descripcion' => 'Descripcion',
            ],
            [
                'nombre' => 'Moquehua',
                'nombre_pila' => 'Moquehua',
                'escudo' => 'Moquehua.png',
                'fecha_creacion' => '1900-01-01',
                'estadio' => 'Estadio Moquehua',
                'descripcion' => 'Descripcion',
            ],
            [
                'nombre' => 'Club Once Tigres',
                'nombre_pila' => 'Once Tigres',
                'escudo' => 'OnceTigres.png',
                'fecha_creacion' => '1900-01-01',
                'estadio' => 'Estadio Once Tigres',
                'descripcion' => 'Descripcion',
            ],
            [
                'nombre' => 'Club Deportivo Pellegrini',
                'nombre_pila' => 'Pellegrini',
                'escudo' => 'Pellegrini.png',
                'fecha_creacion' => '1900-01-01',
                'estadio' => 'Estadio Pellegrini',
                'descripcion' => 'Descripcion',
            ],
            [
                'nombre' => 'Club San Lorenzo Alberti',
                'nombre_pila' => 'San Lorenzo',
                'escudo' => 'SanLorenzo.png',
                'fecha_creacion' => '1900-01-01',
                'estadio' => 'Estadio Alberti',
                'descripcion' => 'Descripcion',
            ],
            [
                'nombre' => 'Club Deportivo, Social y Cultural Florencio Varela',
                'nombre_pila' => 'Varela',
                'escudo' => 'Varela.png',
                'fecha_creacion' => '1900-01-01',
                'estadio' => 'Estadio Varela',
                'descripcion' => 'Descripcion',
            ],
            [
                'nombre' => 'Club Atletico Villarino',
                'nombre_pila' => 'Villarino',
                'escudo' => 'Villarino.png',
                'fecha_creacion' => '1900-01-01',
                'estadio' => 'Estadio Villarino',
                'descripcion' => 'Descripcion',
            ],
        ];

        foreach ($equipos as $equipo) {

            $rutaOrigen = database_path('seeders/assets/escudos/' . $equipo['escudo']);
            $rutaDestino = 'escudos/' . $equipo['escudo'];

            // Copiar imagen a storage/app/public/escudos
            if (File::exists($rutaOrigen)) {
                Storage::disk('public')->put(
                    $rutaDestino,
                    File::get($rutaOrigen)
                );
            }

            Equipo::firstOrCreate(
                ['nombre' => $equipo['nombre']],
                [
                    'nombre_pila' => $equipo['nombre_pila'],
                    'slug' => Str::slug($equipo['nombre_pila']),
                    'fecha_creacion' => $equipo['fecha_creacion'],
                    'estadio' => $equipo['estadio'],
                    'descripcion' => $equipo['descripcion'],
                    'escudo' => $rutaDestino,
                    'activo' => true,
                ]
            );
        }
    }
}
