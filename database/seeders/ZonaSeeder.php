<?php

namespace Database\Seeders;

use App\Models\Torneo;
use App\Models\Fase;
use App\Models\Zona;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ZonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $torneoClausura = Torneo::where('nombre', 'Clausura')->first();

        if (!$torneoClausura) {
            $this->command->error('No se pudo encontrar el torneo Clausura.');
            return;
        }

        $faseGrupos = Fase::where('torneo_id', $torneoClausura->id)
            ->where('nombre', 'Todos contra todos')
            ->first();

        if (!$faseGrupos) {
            $this->command->error('No se pudo encontrar la fase "Todos contra todos" del torneo Clausura.');
            return;
        }

        Zona::updateOrCreate(
            [
                'fase_id' => $faseGrupos->id,
                'nombre' => 'General',
            ]
        );
    }
}

