<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {

    public function up(): void {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo_cliente', ['física', 'jurídica']);
            $table->string('nombre', 100);
            $table->string('apellidos', 100)->nullable();
            $table->string('nif_cif', 20);
            $table->string('telefono', 20);
            $table->string('email', 100);
            $table->string('direccion', 150);
            $table->string('codigo_postal', 10);
            $table->string('localidad', 100);
            $table->string('provincia', 100);
            $table->string('pais', 100)->default('España');
            $table->string('iban', 34)->nullable(); // IBAN para domiciliaciones
            $table->date('fecha_alta')->nullable();
            $table->text('observaciones')->nullable();
            $table->timestamps(); // created_at y updated_at
        });
    }

    public function down(): void {
        Schema::dropIfExists('clientes');
    }
};

