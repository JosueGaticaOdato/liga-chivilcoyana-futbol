<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            EstadioSeeder::class,
            ClubSeeder::class,
            CategoriaSeeder::class,
            EquipoPrimeraSeeder::class,
            TemporadaSeeder::class,
            TorneoSeeder::class,
            FaseSeeder::class,
            ZonaSeeder::class,
            EquipoCompeticionPrimeraSeeder::class,
        ]);
    }
}
