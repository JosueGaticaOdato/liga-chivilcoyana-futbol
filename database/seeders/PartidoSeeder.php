<?php

namespace Database\Seeders;

use App\Models\Fecha;
use App\Services\TablaPosicionesService;
use Illuminate\Database\Seeder;
use App\Models\Partido;
use App\Models\Equipo;
use App\Models\Torneo;
use Carbon\Carbon;

class PartidoSeeder extends Seeder
{
    public function run(): void
    {
        $torneo = Torneo::first(); // o buscá por nombre/slug

        if (!$torneo) {
            $this->command->warn('No hay torneo creado');
            return;
        }

        $equipos = Equipo::pluck('id')->toArray();

        $partidos = [
            // FECHA 1
            [
                'fecha_numero' => 1,
                'local' => 'Independiente',
                'visitante' => 'Gimnasia',
                'fecha' => '2024-03-10',
                'hora' => '16:00',
                'goles_local' => 2,
                'goles_visitante' => 1,
                'estado' => 'finalizado',
            ],
            [
                'fecha_numero' => 1,
                'local' => 'Alsina',
                'visitante' => '22 de Octubre',
                'fecha' => '2024-03-10',
                'hora' => '18:00',
                'goles_local' => 0,
                'goles_visitante' => 0,
                'estado' => 'finalizado',
            ],

            // FECHA 2
            [
                'fecha_numero' => 2,
                'local' => 'Gimnasia',
                'visitante' => 'Alsina',
                'fecha' => '2024-03-17',
                'hora' => '16:00',
                'goles_local' => null,
                'goles_visitante' => null,
                'estado' => 'programado',
            ],
            [
                'fecha_numero' => 2,
                'local' => '22 de Octubre',
                'visitante' => 'Independiente',
                'fecha' => '2024-03-17',
                'hora' => '18:00',
                'goles_local' => null,
                'goles_visitante' => null,
                'estado' => 'programado',
            ],
        ];

        foreach ($partidos as $data) {

            $fecha = Fecha::where('torneo_id', $torneo->id)
                ->where('numero', $data['fecha_numero'])
                ->first();

            $equipoLocal = Equipo::where('nombre_pila', $data['local'])->first();
            $equipoVisitante = Equipo::where('nombre_pila', $data['visitante'])->first();

            if (!$fecha || !$equipoLocal || !$equipoVisitante) {
                continue;
            }

            Partido::create([
                'torneo_id' => $torneo->id,
                'fecha_id' => $fecha->id,
                'equipo_local_id' => $equipoLocal->id,
                'equipo_visitante_id' => $equipoVisitante->id,
                'fecha' => $data['fecha'],
                'hora' => $data['hora'],
                'goles_local' => $data['goles_local'],
                'goles_visitante' => $data['goles_visitante'],
                'estado' => $data['estado'],
            ]);
        }

        // Recalcula puntos (solo sirve para la semilla)
        app(TablaPosicionesService::class)->recalcular($torneo);
    }
}
