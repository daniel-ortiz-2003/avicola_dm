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
        Schema::create('mortality', function (Blueprint $table) {
            $table->id();
            $table->foreignId('poultry_lots_id')->constrained('poultry_lots')->onDelete('cascade')->onUpdate('cascade')->comment('ID del lote de aves al que pertenece la mortalidad');
            $table->integer('quantity')->comment('Cantidad de aves muertas');
            $table->date('date')->comment('Fecha de la mortalidad');
            $table->string('observation')->nullable()->comment('Causa de la mortalidad');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mortality');
    }
};
