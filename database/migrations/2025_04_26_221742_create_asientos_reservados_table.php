<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('asientos_reservados', function (Blueprint $table) {
        $table->id(); 
        $table->unsignedBigInteger('IdFuncion'); // Función/Hora específica
        $table->unsignedBigInteger('IdSala');    // Sala
        $table->string('Fila');                  // Ej: A, B, C
        $table->integer('NumeroAsiento');        // Ej: 1, 2, 3
        $table->timestamps();

        // Relaciones
        $table->foreign('IdFuncion')->references('id')->on('funciones')->onDelete('cascade');
        $table->foreign('IdSala')->references('id')->on('salas')->onDelete('cascade');

        // Evitar reservas duplicadas para el mismo asiento
        $table->unique(['IdFuncion', 'IdSala', 'Fila', 'NumeroAsiento']);
    });
}

    public function down(): void
    {
        Schema::dropIfExists('asientos_reservados');
    }
};
