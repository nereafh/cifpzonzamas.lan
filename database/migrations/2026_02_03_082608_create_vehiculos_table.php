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
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->id();
            $table->string('marca');
            $table->string('modelo');
            $table->string('matricula')->unique();
            $table->string('combustible'); // 'DI' para Diesel, 'GA' para Gasolina, 'EL' para Electrico
            $table->string('estado'); // 'DI' para Disponible, 'AL' para Alquilado, 'TA' para Taller
            $table->integer('anho'); // 2021, 2022, 2023
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehiculos');
    }
};
