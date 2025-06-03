<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

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
            $table->decimal("Precio", 8, 2);
            $table->timestamps();
        });

        DB::table('Precios_Boletos')->insert([
            // Tradicional
            ['Edad' => 'Adulto', 'TipoSala' => 'Tradicional', 'Precio' => 120.00, 'created_at' => now(), 'updated_at' => now()],
            ['Edad' => 'Niño', 'TipoSala' => 'Tradicional', 'Precio' => 80.00, 'created_at' => now(), 'updated_at' => now()],
            ['Edad' => 'Adulto_Mayor', 'TipoSala' => 'Tradicional', 'Precio' => 90.00, 'created_at' => now(), 'updated_at' => now()],
            
            // VIP
            ['Edad' => 'Adulto', 'TipoSala' => 'VIP', 'Precio' => 180.00, 'created_at' => now(), 'updated_at' => now()],
            ['Edad' => 'Niño', 'TipoSala' => 'VIP', 'Precio' => 120.00, 'created_at' => now(), 'updated_at' => now()],
            
            // 3D
            ['Edad' => 'Adulto', 'TipoSala' => '3D', 'Precio' => 150.00, 'created_at' => now(), 'updated_at' => now()],
            ['Edad' => 'Niño', 'TipoSala' => '3D', 'Precio' => 100.00, 'created_at' => now(), 'updated_at' => now()],
            
            // 4D
            ['Edad' => 'Adulto', 'TipoSala' => '4D', 'Precio' => 200.00, 'created_at' => now(), 'updated_at' => now()],
            
            // KIDS
            ['Edad' => 'Niño', 'TipoSala' => 'KIDS', 'Precio' => 100.00, 'created_at' => now(), 'updated_at' => now()],
        ]);

    }
    public function down(): void
    {
        Schema::dropIfExists('Precios_Boletos');
    }
};