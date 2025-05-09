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
        Schema::create('Precios_Boletos', function (Blueprint $table) {
            $table->id("IdBoleto");
            $table->enum("Edad",['Adulto','Niño','Adulto_Mayor']);
            $table->enum("TipoSala",['Tradicional','VIP','3D','4D','KIDS']);
            $table->decimal("Precio", 8,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Precios_Boletos');
    }
};
