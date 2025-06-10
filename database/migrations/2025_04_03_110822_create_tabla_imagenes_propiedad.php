<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('imagenes_propiedad', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('inmueble_id');
        $table->string('ruta_imagen');
        $table->timestamps();

        // Relación con la tabla de propiedades (suponiendo que ya la tengas)
        $table->foreign('inmueble_id')->references('id')->on('inmuebles')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imagenes_propiedad');
    }
};
