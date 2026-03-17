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

            $table->foreignId('torneo_id')
            ->constrained()
            ->cascadeOnDelete();

            $table->string('nombre'); // Liga, Cuartos, Semifinal, Final

            $table->enum('tipo', ['liga', 'eliminacion']);
            // liga → usa tabla de posiciones
            // eliminacion → cruces

            $table->integer('orden');
            // orden de ejecución de la fase

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
