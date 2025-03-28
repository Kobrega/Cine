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
        Schema::create('cines_salas', function (Blueprint $table) {
            $table->id('IdCineSala');
            $table->foreignId('IdCine')->reference('IdCine')->on('cines');
            $table->foreignId('IdSala')->reference('IdSala')->on('salas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cines_salas');
    }
};
