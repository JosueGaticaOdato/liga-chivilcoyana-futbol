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
        Schema::create('fases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('torneo_id')->constrained('torneos')->cascadeOnDelete();
            $table->string('nombre'); // "Fase de grupos", "Zona Campeonato", "Play-offs"
            $table->unsignedTinyInteger('orden')->default(1);
            $table->enum('tipo', ['round_robin', 'eliminacion_simple', 'eliminacion_ida_vuelta']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fases');
    }
};
