<?php

namespace Database\Seeders;

use App\Models\Torneo;
use App\Models\Temporada;
use App\Models\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TorneoSeeder extends Seeder
{
    public function run(): void
    {
        $temporada2026 = Temporada::where('nombre', '2026')->first();
        $categoriaPrimera = Categoria::where('nombre', 'Primera')->first();

        if (!$temporada2026 || !$categoriaPrimera) {
            $this->command->error('No se pudo encontrar la temporada 2026 o la categoría Primera.');
            return;
        }

        $torneos = [
            [
                'nombre' => 'Apertura',
                'temporada_id' => $temporada2026->id,
                'categoria_id' => $categoriaPrimera->id,
                'fecha_inicio' => '2026-03-01',
                'fecha_fin' => '2026-07-31',
                'estado' => 'finalizado',
            ],
            [
                'nombre' => 'Clausura',
                'temporada_id' => $temporada2026->id,
                'categoria_id' => $categoriaPrimera->id,
                'fecha_inicio' => '2026-08-01',
                'fecha_fin' => '2026-12-15',
                'estado' => 'en_curso',
            ],
        ];

        foreach ($torneos as $torneo) {
            $slug = "{$categoriaPrimera->nombre}-{$torneo['nombre']}-{$temporada2026->nombre}";

            Torneo::updateOrCreate(
                [
                    'nombre' => $torneo['nombre'],
                    'temporada_id' => $torneo['temporada_id'],
                    'categoria_id' => $torneo['categoria_id'],
                ],
                [
                    'slug' => $slug,
                    'fecha_inicio' => $torneo['fecha_inicio'],
                    'fecha_fin' => $torneo['fecha_fin'],
                    'estado' => $torneo['estado'],
                ]
            );
        }
    }
}


