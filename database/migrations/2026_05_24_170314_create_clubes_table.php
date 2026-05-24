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
        Schema::create('clubes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('nombre_institucional', 100);
            $table->string('slug')->unique();
            $table->date('fecha_creacion')->nullable();
            $table->string('escudo')->nullable(); // Ruta del escudo
            $table->unsignedBigInteger('estadio_id')->nullable(); // Estadio
            $table->text('descripcion')->nullable();
            $table->timestamps();

            // Foreign Key
            $table->foreign('estadio_id')
                  ->references('id')
                  ->on('estadios')
                  ->nullOnDelete()
                  ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('club');
    }
};
