<?php

namespace Database\Seeders;

use App\Models\Torneo;
use App\Models\Fase;
use App\Models\Zona;
use App\Models\Equipo;
use App\Models\Partido;
use App\Models\Estadio;
use Illuminate\Database\Seeder;

class PartidoPrimeraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $torneo = Torneo::where('nombre', 'Clausura')->first();
        if (!$torneo) {
            $this->command->error('No se pudo encontrar el Torneo Clausura.');
            return;
        }

        $fase = Fase::where('torneo_id', $torneo->id)
            ->where('nombre', 'Todos contra todos')
            ->first();
        if (!$fase) {
            $this->command->error('No se pudo encontrar la fase "Todos contra todos".');
            return;
        }

        $zona = Zona::where('fase_id', $fase->id)
            ->where('nombre', 'General')
            ->first();
        if (!$zona) {
            $this->command->error('No se pudo encontrar la zona "General".');
            return;
        }

        $estadios = Estadio::all();

        // Helper to retrieve an Equipo by club name in the context of Primera Category
        $getEquipo = function (string $clubName) {
            return Equipo::whereHas('club', function ($q) use ($clubName) {
                $q->where('nombre', $clubName);
            })->first();
        };

        // Clear existing matches for this fixture and tournament
        Partido::where('torneo_id', $torneo->id)
            ->where('jornada', 1)
            ->delete();

        // Matches configuration
        $matches = [
            [
                'local' => 'Independiente',
                'visitante' => 'Gimnasia',
                'fecha_hora' => '2026-08-01 15:30:00',
                'estado' => 'finalizado',
                'goles_local' => 2,
                'goles_visitante' => 1,
            ],
            [
                'local' => 'Alsina',
                'visitante' => 'Ceramica',
                'fecha_hora' => '2026-08-01 15:30:00',
                'estado' => 'finalizado',
                'goles_local' => 1,
                'goles_visitante' => 1,
            ],
            [
                'local' => 'Ciclon',
                'visitante' => 'Colon',
                'fecha_hora' => '2026-08-01 15:30:00',
                'estado' => 'finalizado',
                'goles_local' => 0,
                'goles_visitante' => 2,
            ],
            [
                'local' => 'Huracan',
                'visitante' => 'Moquehua',
                'fecha_hora' => '2026-08-01 15:30:00',
                'estado' => 'finalizado',
                'goles_local' => 3,
                'goles_visitante' => 2,
            ],
            [
                'local' => 'Once Tigres',
                'visitante' => 'Pellegrini',
                'fecha_hora' => '2026-08-02 16:00:00',
                'estado' => 'en_vivo',
                'goles_local' => 1,
                'goles_visitante' => 0,
            ],
            [
                'local' => 'San Lorenzo',
                'visitante' => 'Varela',
                'fecha_hora' => '2026-08-02 18:00:00',
                'estado' => 'programado',
                'goles_local' => null,
                'goles_visitante' => null,
            ],
            [
                'local' => 'Villarino',
                'visitante' => '22 de Octubre',
                'fecha_hora' => '2026-08-02 18:00:00',
                'estado' => 'programado',
                'goles_local' => null,
                'goles_visitante' => null,
            ],
        ];

        foreach ($matches as $match) {
            $eqLocal = $getEquipo($match['local']);
            $eqVisitante = $getEquipo($match['visitante']);

            if (!$eqLocal || !$eqVisitante) {
                $this->command->error("No se pudo encontrar el equipo para local: {$match['local']} o visitante: {$match['visitante']}");
                continue;
            }

            $clubLocal = $eqLocal->club;
            $estadioId = $clubLocal->estadio_id ?? ($estadios->random()->id ?? null);

            // Create partido using manual properties assignment to bypass mass assignment constraints
            $partido = new Partido();
            $partido->torneo_id = $torneo->id;
            $partido->fase_id = $fase->id;
            $partido->zona_id = $zona->id;
            $partido->equipo_local_id = $eqLocal->id;
            $partido->equipo_visitante_id = $eqVisitante->id;
            $partido->estadio_id = $estadioId;
            $partido->jornada = 1;
            $partido->fecha_hora = $match['fecha_hora'];
            $partido->estado = $match['estado'];
            $partido->goles_local = $match['goles_local'];
            $partido->goles_visitante = $match['goles_visitante'];
            $partido->save();
        }
    }
}
