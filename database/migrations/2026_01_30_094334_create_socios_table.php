<?php

//php artisan migrate
//php artisan migrate:fresh --seed 
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
        Schema::create('socios', function (Blueprint $table) {
        $table->id();
        $table->string('nombre');
        $table->string('dni')->unique();
        $table->integer('edad');
        $table->string('categoria'); // 'PL' para Plata, 'OR' para Oro
        $table->string('iban');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('socios');
    }
};
