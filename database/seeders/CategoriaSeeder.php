<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            ['nombre' => 'Primera', 'orden' => 1],
            ['nombre' => 'Sub-23', 'orden' => 2],
            ['nombre' => 'Sub-18', 'orden' => 3],
            ['nombre' => 'Sub-15', 'orden' => 4],
            ['nombre' => 'Sub-13', 'orden' => 5],
            ['nombre' => 'Senior', 'orden' => 6],
        ];

        foreach ($categorias as $categoria) {
            Categoria::updateOrCreate(
                ['nombre' => $categoria['nombre']],
                ['orden' => $categoria['orden']]
            );
        }
    }
}

