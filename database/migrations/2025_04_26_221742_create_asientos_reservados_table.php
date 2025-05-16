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
    $table->unsignedBigInteger('IdReserva');
    $table->unsignedBigInteger('IdFuncion');
    $table->unsignedBigInteger('IdSala');
    $table->string('Fila', 2); // Ej: 'A', 'B', etc.
    $table->integer('NumeroAsiento');
    $table->timestamps();
    
    $table->foreign('IdReserva')->references('id')->on('reservaciones');
    $table->foreign('IdFuncion')->references('IdFuncion')->on('funciones');
    $table->foreign('IdSala')->references('IdSala')->on('salas');
});
}

    public function down(): void
    {
        Schema::dropIfExists('asientos_reservados');
    }
};
