<?php

namespace Database\Seeders;

use App\Models\Noticia;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NoticiaSeeder extends Seeder
{
    public function run(): void
    {
        $noticias = [
            [
                'titulo' => 'Arranca el Torneo Apertura 2025',
                'descripcion' => 'Este fin de semana comienza el Torneo Apertura con grandes expectativas.',
                'contenido' => 'El Torneo Apertura 2025 dará inicio este sábado con partidos en todas las categorías...',
                'imagen' => 'noticia.jpg',
                'fecha_publicacion' => '2025-03-01',
                'autor' => 'Liga Chivilcoyana',
            ],
            [
                'titulo' => 'Independiente ganó en el debut',
                'descripcion' => 'El Rojo arrancó el torneo con una sólida victoria como local.',
                'contenido' => 'Independiente mostró un gran nivel colectivo y se impuso 2 a 0...',
                'imagen' => 'noticia2.jpg',
                'fecha_publicacion' => '2025-03-03',
                'autor' => 'Redacción LCF',
            ],
            [
                'titulo' => 'Gimnasia presentó su nuevo cuerpo técnico',
                'descripcion' => 'El Lobo confirmó su nuevo DT de cara a la temporada.',
                'contenido' => 'En conferencia de prensa, Gimnasia presentó oficialmente a su nuevo entrenador...',
                'imagen' => 'noticia3.jpg',
                'fecha_publicacion' => '2025-02-27',
                'autor' => 'Prensa Gimnasia',
            ],
        ];

        foreach ($noticias as $data) {

            $rutaImagen = null;

            if (!empty($data['imagen'])) {
                $origen = database_path('seeders/assets/noticias/' . $data['imagen']);
                $destino = 'noticias/' . $data['imagen'];

                if (File::exists($origen)) {
                    Storage::disk('public')->put(
                        $destino,
                        File::get($origen)
                    );
                    $rutaImagen = $destino;
                }
            }

            Noticia::firstOrCreate(
                ['titulo' => $data['titulo']],
                [
                    'slug' => Str::slug($data['titulo']),
                    'descripcion' => $data['descripcion'],
                    'contenido' => $data['contenido'],
                    'imagen' => $rutaImagen,
                    'fecha_publicacion' => $data['fecha_publicacion'],
                    'autor' => $data['autor'],
                    'visitas' => rand(0, 50),
                ]
            );
        }
    }
}
