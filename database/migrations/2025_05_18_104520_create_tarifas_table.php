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
Schema::create('tarifas', function (Blueprint $table) {
    $table->id();
    $table->string('nombre', 50);
    $table->decimal('precio', 8, 2)->nullable(); // por si quieres mostrarlo
    $table->text('descripcion')->nullable();
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarifas');
    }
};
