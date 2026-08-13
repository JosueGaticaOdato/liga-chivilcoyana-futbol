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
        Schema::create('eventos_partido', function (Blueprint $table) {
            $table->id();

            # Foreign keys
            $table->foreignId('partido_id')->constrained('partidos')->cascadeOnDelete();
            $table->foreignId('equipo_id')->constrained('equipos')->cascadeOnDelete();
            $table->foreignId('jugador_id')->nullable()->constrained('jugadores')->nullOnDelete();

            $table->enum('tipo_evento', [
                'gol',
                'autogol',
                'penal_convertido',
                'penal_errado',
                'tarjeta_amarilla',
                'tarjeta_roja',
                'doble_amarilla',
                #'cambio_entra',
                #'cambio_sale',
            ]);


            $table->unsignedTinyInteger('minuto');
            $table->text('detalle')->nullable();

            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eventos_partido');
    }
};
