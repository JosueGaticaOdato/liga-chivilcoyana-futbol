<?php

namespace Database\Seeders;

use App\Models\Club;
use App\Models\Categoria;
use App\Models\Equipo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EquipoPrimeraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoriaPrimera = Categoria::where('nombre', 'Primera')->first();

        if (!$categoriaPrimera) {
            $this->command->error('La categoría "Primera" no existe. Asegúrate de ejecutar CategoriaSeeder primero.');
            return;
        }

        $clubes = Club::all();

        foreach ($clubes as $club) {
            Equipo::updateOrCreate(
                [
                    'club_id' => $club->id,
                    'categoria_id' => $categoriaPrimera->id,
                ],
                [
                    'nombre' => null,
                    'activo' => true,
                ]
            );
        }
    }
}

