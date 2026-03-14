<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fechas', function (Blueprint $table) {
            $table->id();

            // Fechas es una jornada dentro de una fase
            $table->foreignId('fase_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->integer('numero'); // Numero de jornada dentro de la fase
            $table->string('nombre')->nullable();  // "Fecha 1", "Cuartos", "Semifinal"

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fechas');
    }
};
