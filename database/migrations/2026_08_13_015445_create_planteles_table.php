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
        Schema::create('planteles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jugador_id')->constrained('jugadores')->cascadeOnDelete();
            $table->foreignId('equipo_id')->constrained('equipos')->cascadeOnDelete();
            $table->foreignId('temporada_id')->constrained('temporadas')->cascadeOnDelete();
            $table->unsignedSmallInteger('dorsal')->nullable();
            $table->date('fecha_incorporacion')->nullable();
            $table->date('fecha_baja')->nullable();
            $table->boolean('activo')->default(true);
 
            $table->unique(['jugador_id', 'equipo_id', 'temporada_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('planteles');
    }
};
