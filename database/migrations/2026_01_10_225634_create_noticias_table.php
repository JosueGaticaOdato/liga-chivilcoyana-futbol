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
        Schema::create('noticias', function (Blueprint $table) {
            $table->id();

            $table->string('titulo');
            $table->string('slug')->unique();

            $table->text('descripcion'); // resumen
            $table->longText('contenido')->nullable(); //cuerpo completo

            $table->string('imagen')->nullable(); // path storage

            $table->date('fecha_publicacion')->nullable();
            $table->unsignedInteger('visitas')->default(0);
            $table->string('autor')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('noticias');
    }
};
