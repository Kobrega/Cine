<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reservaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('IdFuncion')->constrained('Funcion');
            $table->dateTime('FechaReserva');
            $table->string('Estado')->default('pendiente');
            $table->string('asiento', 10);
            $table->decimal('Total', 8, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reservaciones');
    }
};