<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('visitas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('inmueble_id');
            $table->unsignedBigInteger('cliente_id');
            $table->date('fechaVisita');
            $table->time('horaVisita');
            $table->enum('estado', ['pendiente', 'confirmada', 'realizada', 'cancelada'])->default('pendiente');
            $table->text('observaciones')->nullable();
            $table->boolean('acuerdo_generado')->default(false);  // Estado del acuerdo
            $table->string('acuerdo_pdf')->nullable();  // Ruta del archivo PDF generado
            $table->timestamps();

            // Definir las relaciones
            $table->foreign('inmueble_id')->references('id')->on('inmuebles')->onDelete('cascade');
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
        });
    }


    public function down(): void {
        Schema::dropIfExists('visitas');
    }
};
