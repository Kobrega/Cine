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
        Schema::create('salas_peliculas', function (Blueprint $table) {
            $table->id('IdSalasPeli');
            $table->foreignId('IdPelicula')->reference('IdPelicula')->on('peliculas');
            $table->foreignId('IdSala')->reference('IdSala')->on('salas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salas_peliculas');
    }
};
