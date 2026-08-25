<?php

namespace Database\Seeders;

use App\Models\Torneo;
use App\Models\Fase;
use App\Models\Zona;
use App\Models\Categoria;
use App\Models\Equipo;
use App\Models\EquipoCompeticion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EquipoCompeticionPrimeraSeeder extends Seeder
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

        $zonaGeneral = Zona::where('fase_id', $faseGrupos->id)
            ->where('nombre', 'General')
            ->first();

        if (!$zonaGeneral) {
            $this->command->error('No se pudo encontrar la zona "General" del torneo Clausura.');
            return;
        }

        $categoriaPrimera = Categoria::where('nombre', 'Primera')->first();

        if (!$categoriaPrimera) {
            $this->command->error('No se pudo encontrar la categoría "Primera".');
            return;
        }

        $equipos = Equipo::where('categoria_id', $categoriaPrimera->id)->get();

        foreach ($equipos as $equipo) {
            EquipoCompeticion::updateOrCreate(
                [
                    'zona_id' => $zonaGeneral->id,
                    'equipo_id' => $equipo->id,
                ],
                [
                    'estado' => 'activo',
                    'sembrado' => null,
                    'partidos_jugados' => 0,
                    'ganados' => 0,
                    'empatados' => 0,
                    'perdidos' => 0,
                    'goles_favor' => 0,
                    'goles_contra' => 0,
                    'puntos' => 0,
                    'puntos_deducidos' => 0,
                ]
            );
        }
    }
}

