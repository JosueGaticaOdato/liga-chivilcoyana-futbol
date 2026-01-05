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
        Schema::create('equipo_torneo', function (Blueprint $table) {
            $table->id();

            $table->foreignId('equipo_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('torneo_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->integer('partidos_jugados')->default(0);
            $table->integer('ganados')->default(0);
            $table->integer('empatados')->default(0);
            $table->integer('perdidos')->default(0);
            $table->integer('goles_favor')->default(0);
            $table->integer('goles_contra')->default(0);
            $table->integer('diferencia_goles')->default(0);
            $table->integer('puntos')->default(0);

            $table->timestamps();

            $table->unique(['equipo_id', 'torneo_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipo_torneo');
    }
};
