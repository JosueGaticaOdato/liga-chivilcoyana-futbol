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
        Schema::create('temporadas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); // "2026"
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            
            $table->boolean('activa')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temporadas');
    }
};
