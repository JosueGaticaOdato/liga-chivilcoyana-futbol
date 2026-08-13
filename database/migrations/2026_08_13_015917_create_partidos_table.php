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

            # Foreign keys
            $table->foreignId('torneo_id')->constrained('torneos')->cascadeOnDelete();
            $table->foreignId('fase_id')->constrained('fases')->cascadeOnDelete();
            $table->foreignId('zona_id')->constrained('zonas')->cascadeOnDelete();
 
            $table->unsignedTinyInteger('jornada')->nullable(); // fecha/jornada en fase todos contra todos
            $table->string('llave')->nullable(); // ej "Cuartos - Llave 1", para fase eliminación
            $table->foreignId('partido_vuelta_id')->nullable()->constrained('partidos')->nullOnDelete();
 
            # Foreign keys equipo y estadio
            $table->foreignId('equipo_local_id')->constrained('equipos')->cascadeOnDelete();
            $table->foreignId('equipo_visitante_id')->constrained('equipos')->cascadeOnDelete();
            $table->foreignId('estadio_id')->nullable()->constrained('estadios')->nullOnDelete();
 
            $table->dateTime('fecha_hora')->nullable();
            $table->enum('estado', ['programado', 'en_vivo', 'finalizado', 'suspendido', 'postergado'])
                ->default('programado');
 
            # Goles
            $table->unsignedTinyInteger('goles_local')->nullable();
            $table->unsignedTinyInteger('goles_visitante')->nullable();
            $table->unsignedTinyInteger('goles_local_penales')->nullable();
            $table->unsignedTinyInteger('goles_visitante_penales')->nullable();

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
