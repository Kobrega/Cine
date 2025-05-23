<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
    Schema::create('reservaciones', function (Blueprint $table) {
    $table->id('IdReserva');
    $table->foreignId('IdFuncion')->references('IdFuncion')->on('funciones');
    $table->string('asiento');
    $table->boolean('reservado');
    $table->timestamps();
    });

    }

    public function down()
    {
        Schema::dropIfExists('reservaciones');
    }
};