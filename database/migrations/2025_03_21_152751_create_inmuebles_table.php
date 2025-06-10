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
        Schema::create('inmuebles', function (Blueprint $table) {
            $table->id(); // id, campo auto-incremental
            $table->string('calle'); // Calle
            $table->string('numero'); // Número
            $table->string('codigo_postal'); // Código postal
            $table->string('poblacion'); // Población
            $table->string('provincia'); // Provincia
            $table->decimal('m2', 8, 2); // Metros cuadrados
            $table->integer('habitaciones'); // Habitaciones
            $table->integer('banos'); // Baños
            $table->boolean('terraza'); // Terraza (booleano)
            $table->boolean('garaje'); // Garaje (booleano)
            $table->boolean('piscina'); // Piscina (booleano)
            $table->decimal('precio', 10, 2); // Precio
            $table->decimal('precio_m2', 10, 2); // Precio por m2
            $table->string('estado'); // Estado del inmueble
            $table->string('zona'); // Zona
            $table->string('propietario'); // Propietario
            $table->string('telefono'); // Teléfono del propietario
            $table->text('observaciones')->nullable(); // Observaciones
            $table->text('descripcion')->nullable(); // Descripción (campo de texto largo)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inmuebles');
    }
};
