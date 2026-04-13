<?php

namespace Database\Seeders;

use App\Models\Fase;
use App\Models\Fecha;
use App\Models\Zona;
use App\Services\TablaPosicionesService;
use Illuminate\Database\Seeder;
use App\Models\Partido;
use App\Models\Equipo;
use App\Models\Torneo;
use App\Services\TablaService;
use Carbon\Carbon;

class PartidoSeeder extends Seeder
{
    public function run(): void
    {
        $torneo = Torneo::where('slug', 'apertura-2026')->first();

        $faseGrupos = Fase::where('torneo_id', $torneo->id)
            ->where('nombre', 'Fase de Grupos')
            ->first();

        $fasePlayoffs = Fase::where('torneo_id', $torneo->id)
            ->where('nombre', 'Playoffs')
            ->first();

        $zonaA = Zona::where('fase_id', $faseGrupos->id)
            ->where('nombre', 'Zona A')
            ->first();

        $zonaB = Zona::where('fase_id', $faseGrupos->id)
            ->where('nombre', 'Zona B')
            ->first();

        // Fechas
        $fecha1 = Fecha::where('fase_id', $faseGrupos->id)->where('numero', 1)->first();
        $fecha2 = Fecha::where('fase_id', $faseGrupos->id)->where('numero', 2)->first();
        $fecha3 = Fecha::where('fase_id', $faseGrupos->id)->where('numero', 3)->first();
        $fecha4 = Fecha::where('fase_id', $faseGrupos->id)->where('numero', 4)->first();
        $fecha5 = Fecha::where('fase_id', $faseGrupos->id)->where('numero', 5)->first();
        $fechaFinal = Fecha::where('fase_id', $fasePlayoffs->id)->first();

        // Partidos
        $partidos = [

            // ZONA A - FECHA 1
            [
                'fase_id' => $faseGrupos->id,
                'fecha_id' => $fecha1->id,
                'zona_id' => $zonaA->id,
                'local' => 'Gimnasia',
                'visitante' => 'Moquehua',
                'fecha_partido' => '2026-03-10',
                'hora_partido' => '16:00',
                'goles_local' => 2,
                'goles_visitante' => 1,
                'estado' => 'finalizado',
            ],
            [
                'fase_id' => $faseGrupos->id,
                'fecha_id' => $fecha1->id,
                'zona_id' => $zonaA->id,
                'local' => 'San Lorenzo',
                'visitante' => 'Varela',
                'fecha_partido' => '2026-03-10',
                'hora_partido' => '16:00',
                'goles_local' => 1,
                'goles_visitante' => 2,
                'estado' => 'finalizado',
            ],
            [
                'fase_id' => $faseGrupos->id,
                'fecha_id' => $fecha1->id,
                'zona_id' => $zonaA->id,
                'local' => 'Ceramica',
                'visitante' => 'Independiente',
                'fecha_partido' => '2026-03-10',
                'hora_partido' => '16:00',
                'goles_local' => 0,
                'goles_visitante' => 2,
                'estado' => 'finalizado',
            ],

            // ZONA B - FECHA 1
            [
                'fase_id' => $faseGrupos->id,
                'fecha_id' => $fecha1->id,
                'zona_id' => $zonaB->id,
                'local' => 'Colon',
                'visitante' => 'Villarino',
                'fecha_partido' => '2026-03-10',
                'hora_partido' => '16:00',
                'goles_local' => 0,
                'goles_visitante' => 2,
                'estado' => 'finalizado',
            ],
            [
                'fase_id' => $faseGrupos->id,
                'fecha_id' => $fecha1->id,
                'zona_id' => $zonaB->id,
                'local' => 'Huracan',
                'visitante' => 'Pellegrini',
                'fecha_partido' => '2026-03-10',
                'hora_partido' => '16:00',
                'goles_local' => 2,
                'goles_visitante' => 1,
                'estado' => 'finalizado',
            ],
            [
                'fase_id' => $faseGrupos->id,
                'fecha_id' => $fecha1->id,
                'zona_id' => $zonaB->id,
                'local' => 'Alsina',
                'visitante' => 'Once Tigres',
                'fecha_partido' => '2026-03-10',
                'hora_partido' => '16:00',
                'goles_local' => 1,
                'goles_visitante' => 2,
                'estado' => 'finalizado',
            ],
            // [
            //     'fase_id' => $faseGrupos->id,
            //     'fecha_id' => $fecha1->id,
            //     'zona_id' => $zonaB->id,
            //     'local' => 'Colon',
            //     'visitante' => '22 de Octubre',
            //     'fecha_partido' => '2026-03-10',
            //     'hora_partido' => '18:00',
            //     'goles_local' => 0,
            //     'goles_visitante' => 0,
            //     'estado' => 'finalizado',
            // ],

            // ZONA A - FECHA 2
            // [
            //     'fase_id' => $faseGrupos->id,
            //     'fecha_id' => $fecha2->id,
            //     'zona_id' => $zonaA->id,
            //     'local' => 'Gimnasia',
            //     'visitante' => 'Independiente',
            //     'fecha_partido' => '2026-03-17',
            //     'hora_partido' => '16:00',
            //     'goles_local' => null,
            //     'goles_visitante' => null,
            //     'estado' => 'programado',
            // ],

            // ZONA A - FECHA 2
            [
                'fase_id' => $faseGrupos->id,
                'fecha_id' => $fecha2->id,
                'zona_id' => $zonaA->id,
                'local' => 'Independiente',
                'visitante' => 'San Lorenzo',
                'fecha_partido' => '2026-03-10',
                'hora_partido' => '16:00',
                'goles_local' => 3,
                'goles_visitante' => 1,
                'estado' => 'finalizado',
            ],
            [
                'fase_id' => $faseGrupos->id,
                'fecha_id' => $fecha2->id,
                'zona_id' => $zonaA->id,
                'local' => 'Varela',
                'visitante' => 'Gimnasia',
                'fecha_partido' => '2026-03-10',
                'hora_partido' => '16:00',
                'goles_local' => 0,
                'goles_visitante' => 2,
                'estado' => 'finalizado',
            ],
            // ZONA B - FECHA 2
            [
                'fase_id' => $faseGrupos->id,
                'fecha_id' => $fecha2->id,
                'zona_id' => $zonaB->id,
                'local' => 'Villarino',
                'visitante' => 'Huracan',
                'fecha_partido' => '2026-03-10',
                'hora_partido' => '16:00',
                'goles_local' => 1,
                'goles_visitante' => 2,
                'estado' => 'finalizado',
            ],
            [
                'fase_id' => $faseGrupos->id,
                'fecha_id' => $fecha2->id,
                'zona_id' => $zonaB->id,
                'local' => 'Pellegrini',
                'visitante' => 'Alsina',
                'fecha_partido' => '2026-03-10',
                'hora_partido' => '16:00',
                'goles_local' => 1,
                'goles_visitante' => 4,
                'estado' => 'finalizado',
            ],
            [
                'fase_id' => $faseGrupos->id,
                'fecha_id' => $fecha2->id,
                'zona_id' => $zonaB->id,
                'local' => 'Once Tigres',
                'visitante' => '22 de Octubre',
                'fecha_partido' => '2026-03-10',
                'hora_partido' => '16:00',
                'goles_local' => 2,
                'goles_visitante' => 1,
                'estado' => 'finalizado',
            ],

             // ZONA A - FECHA 3
            [
                'fase_id' => $faseGrupos->id,
                'fecha_id' => $fecha3->id,
                'zona_id' => $zonaA->id,
                'local' => 'Gimnasia',
                'visitante' => 'Independiente',
                'fecha_partido' => '2026-03-10',
                'hora_partido' => '16:00',
                'goles_local' => 3,
                'goles_visitante' => 1,
                'estado' => 'finalizado',
            ],
            [
                'fase_id' => $faseGrupos->id,
                'fecha_id' => $fecha3->id,
                'zona_id' => $zonaA->id,
                'local' => 'San Lorenzo',
                'visitante' => 'Ceramica',
                'fecha_partido' => '2026-03-10',
                'hora_partido' => '16:00',
                'goles_local' => 3,
                'goles_visitante' => 2,
                'estado' => 'finalizado',
            ],
            // ZONA B - FECHA 3
            [
                'fase_id' => $faseGrupos->id,
                'fecha_id' => $fecha3->id,
                'zona_id' => $zonaB->id,
                'local' => 'Huracan',
                'visitante' => 'Colon',
                'fecha_partido' => '2026-03-10',
                'hora_partido' => '16:00',
                'goles_local' => 0,
                'goles_visitante' => 1,
                'estado' => 'finalizado',
            ],
            [
                'fase_id' => $faseGrupos->id,
                'fecha_id' => $fecha3->id,
                'zona_id' => $zonaB->id,
                'local' => 'Alsina',
                'visitante' => 'Villarino',
                'fecha_partido' => '2026-03-10',
                'hora_partido' => '16:00',
                'goles_local' => 2,
                'goles_visitante' => 3,
                'estado' => 'finalizado',
            ],
            [
                'fase_id' => $faseGrupos->id,
                'fecha_id' => $fecha3->id,
                'zona_id' => $zonaB->id,
                'local' => '22 de Octubre',
                'visitante' => 'Pellegrini',
                'fecha_partido' => '2026-03-10',
                'hora_partido' => '16:00',
                'goles_local' => 2,
                'goles_visitante' => 2,
                'estado' => 'finalizado',
            ],
            // ZONA A - FECHA 4
            [
                'fase_id' => $faseGrupos->id,
                'fecha_id' => $fecha4->id,
                'zona_id' => $zonaA->id,
                'local' => 'Ceramica',
                'visitante' => 'Gimnasia',
                'fecha_partido' => '2026-03-10',
                'hora_partido' => '16:00',
                'goles_local' => 0,
                'goles_visitante' => 5,
                'estado' => 'finalizado',
            ],
            [
                'fase_id' => $faseGrupos->id,
                'fecha_id' => $fecha4->id,
                'zona_id' => $zonaA->id,
                'local' => 'Varela',
                'visitante' => 'Moquehua',
                'fecha_partido' => '2026-03-10',
                'hora_partido' => '16:00',
                'goles_local' => 3,
                'goles_visitante' => 1,
                'estado' => 'finalizado',
            ],
            // ZONA B - FECHA 4
            [
                'fase_id' => $faseGrupos->id,
                'fecha_id' => $fecha4->id,
                'zona_id' => $zonaB->id,
                'local' => 'Colon',
                'visitante' => 'Alsina',
                'fecha_partido' => '2026-03-10',
                'hora_partido' => '16:00',
                'goles_local' => 5,
                'goles_visitante' => 0,
                'estado' => 'finalizado',
            ],
            [
                'fase_id' => $faseGrupos->id,
                'fecha_id' => $fecha4->id,
                'zona_id' => $zonaB->id,
                'local' => 'Villarino',
                'visitante' => '22 de Octubre',
                'fecha_partido' => '2026-03-10',
                'hora_partido' => '16:00',
                'goles_local' => 1,
                'goles_visitante' => 1,
                'estado' => 'finalizado',
            ],
            [
                'fase_id' => $faseGrupos->id,
                'fecha_id' => $fecha4->id,
                'zona_id' => $zonaB->id,
                'local' => 'Pellegrini',
                'visitante' => 'Once Tigres',
                'fecha_partido' => '2026-03-10',
                'hora_partido' => '16:00',
                'goles_local' => 0,
                'goles_visitante' => 4,
                'estado' => 'finalizado',
            ],


            // ZONA A - FECHA 5
            [
                'fase_id' => $faseGrupos->id,
                'fecha_id' => $fecha5->id,
                'zona_id' => $zonaA->id,
                'local' => 'Gimnasia',
                'visitante' => 'San Lorenzo',
                'fecha_partido' => '2026-03-10',
                'hora_partido' => '16:00',
                'goles_local' => 1,
                'goles_visitante' => 1,
                'estado' => 'finalizado',
            ],
            [
                'fase_id' => $faseGrupos->id,
                'fecha_id' => $fecha5->id,
                'zona_id' => $zonaA->id,
                'local' => 'Moquehua',
                'visitante' => 'Independiente',
                'fecha_partido' => '2026-03-10',
                'hora_partido' => '16:00',
                'goles_local' => 2,
                'goles_visitante' => 2,
                'estado' => 'finalizado',
            ],
            // ZONA B - FECHA 5
            [
                'fase_id' => $faseGrupos->id,
                'fecha_id' => $fecha5->id,
                'zona_id' => $zonaB->id,
                'local' => 'Once Tigres',
                'visitante' => 'Villarino',
                'fecha_partido' => '2026-03-10',
                'hora_partido' => '16:00',
                'goles_local' => 0,
                'goles_visitante' => 0,
                'estado' => 'finalizado',
            ],
            [
                'fase_id' => $faseGrupos->id,
                'fecha_id' => $fecha5->id,
                'zona_id' => $zonaB->id,
                'local' => 'Alsina',
                'visitante' => 'Huracan',
                'fecha_partido' => '2026-03-10',
                'hora_partido' => '16:00',
                'goles_local' => 2,
                'goles_visitante' => 1,
                'estado' => 'finalizado',
            ],
            [
                'fase_id' => $faseGrupos->id,
                'fecha_id' => $fecha5->id,
                'zona_id' => $zonaB->id,
                'local' => '22 de Octubre',
                'visitante' => 'Colon',
                'fecha_partido' => '2026-03-10',
                'hora_partido' => '16:00',
                'goles_local' => 1,
                'goles_visitante' => 3,
                'estado' => 'finalizado',
            ],


            // FINAL (PLAYOFF)
            // [
            //     'fase_id' => $fasePlayoffs->id,
            //     'fecha_id' => $fechaFinal->id,
            //     'zona_id' => null, // 🔥 en playoffs no hay zona
            //     'local' => 'Independiente',
            //     'visitante' => '22 de Octubre',
            //     'fecha_partido' => '2026-03-25',
            //     'hora_partido' => '18:00',
            //     'goles_local' => null,
            //     'goles_visitante' => null,
            //     'estado' => 'programado',
            //     //'numero_llave' => 1
            // ],
        ];

        foreach ($partidos as $data) {

            $equipoLocal = Equipo::where('nombre', $data['local'])->first();
            $equipoVisitante = Equipo::where('nombre', $data['visitante'])->first();

            if (!$equipoLocal || !$equipoVisitante) {
                continue;
            }

            Partido::create([
                'torneo_id' => $torneo->id,
                'fase_id' => $data['fase_id'],
                'fecha_id' => $data['fecha_id'],
                'zona_id' => $data['zona_id'],
                'equipo_local_id' => $equipoLocal->id,
                'equipo_visitante_id' => $equipoVisitante->id,
                'fecha_partido' => $data['fecha_partido'],
                'hora_partido' => $data['hora_partido'],
                'goles_local' => $data['goles_local'],
                'goles_visitante' => $data['goles_visitante'],
                'estado' => $data['estado'],
                //'numero_llave' => $data['numero_llave'] ?? null,
            ]);
        }

        $fases = Fase::where('torneo_id', $torneo->id)->get();
        foreach ($fases as $fase) {

            // Solo si es fase de grupos (tabla de posiciones)
            if ($fase->tipo === 'liga') {
                app(TablaService::class)->recalcular($fase);
            }
        }
    }
}
