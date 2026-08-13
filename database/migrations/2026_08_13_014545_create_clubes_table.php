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
            $table->date('fecha_fundacion')->nullable();
            $table->string('presidente')->nullable();
            $table->text('descripcion')->nullable();
            $table->foreignId('estadio_id')->nullable()->constrained('estadios')->nullOnDelete();
            $table->string('escudo')->nullable(); // Ruta del escudo
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clubes');
    }
};
