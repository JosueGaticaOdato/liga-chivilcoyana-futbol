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
        Schema::create('partidos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('torneo_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('fecha_id')
                ->constrained('fechas')
                ->cascadeOnDelete();

            $table->date('fecha_partido');
            $table->time('hora_partido')->nullable();

            $table->foreignId('equipo_local_id')
                ->constrained('equipos');

            $table->foreignId('equipo_visitante_id')
                ->constrained('equipos');

            $table->integer('goles_local')->nullable();
            $table->integer('goles_visitante')->nullable();

            $table->enum('estado', ['programado', 'en_juego', 'finalizado'])
                ->default('programado');

            $table->foreignId(column: 'estadio_id')
                ->constrained('estadios')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partidos');
    }
};
