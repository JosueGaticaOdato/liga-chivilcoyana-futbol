<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('equipo_competicion', function (Blueprint $table) {
            $table->id();
            $table->foreignId('zona_id')->constrained('zonas')->cascadeOnDelete();
            $table->foreignId('equipo_id')->constrained('equipos')->cascadeOnDelete();

            // Estado del equipo dentro de la zona/fase
            $table->enum('estado', ['activo', 'eliminado', 'clasificado', 'campeon'])
                ->default('activo');

            // Posición de siembra, solo se usa en fases de eliminación. Se usa para armar el cuadro de eliminacion de forma pareja, de modo que los equipos mejor sembrados se enfrenten a los peor sembrados. Se puede usar para mostrar la posición de siembra en la tabla de posiciones.
            $table->unsignedTinyInteger('sembrado')->nullable();

            // Estadísticas — solo tienen sentido en fases round_robin
            $table->unsignedSmallInteger('partidos_jugados')->default(0);
            $table->unsignedSmallInteger('ganados')->default(0);
            $table->unsignedSmallInteger('empatados')->default(0);
            $table->unsignedSmallInteger('perdidos')->default(0);
            $table->unsignedSmallInteger('goles_favor')->default(0);
            $table->unsignedSmallInteger('goles_contra')->default(0);
            $table->smallInteger('diferencia_goles')
                ->storedAs('goles_favor - goles_contra');
            $table->unsignedSmallInteger('puntos')->default(0);
            $table->unsignedSmallInteger('puntos_deducidos')->default(0);

            // Un equipo no puede repetirse dentro de la misma zona
            $table->unique(['zona_id', 'equipo_id']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipo_competicion');
    }
};
