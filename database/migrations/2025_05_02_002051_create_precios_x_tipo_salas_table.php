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
        Schema::create('precios_x_tipo_salas', function (Blueprint $table) {
            $table->id("IdPrecioTipoSala");
            $table->foreignId('IdSala')->reference('IdSala')->on('salas');
            $table->string("BoletoXTipo",20);
            $table->decimal("Precio", 8,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('precios_x_tipo_salas');
    }
};
