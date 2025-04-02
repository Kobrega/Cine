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
        Schema::create('cines', function (Blueprint $table) {
            $table->id('IdCine');
            $table->string('NomCine',50);
            $table->string('Direccion',60);
            $table->time('HorarioA');
            $table->time('HorarioC');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cines');
    }
};
