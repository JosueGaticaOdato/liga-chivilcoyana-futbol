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

            $table->foreignId('torneo_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->integer('numero'); // Fecha 1, 2, 3, ...
            $table->string('nombre')->nullable(); // "Fecha 1", "Cuartos"

            $table->timestamps();

            $table->unique(['torneo_id', 'numero']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fechas');
    }
};
