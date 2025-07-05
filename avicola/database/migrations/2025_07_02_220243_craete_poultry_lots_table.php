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
        Schema::create('poultry_lots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sheds_id')->constrained('sheds')->onDelete('cascade')->onUpdate('cascade')->comment('ID del galpón al que pertenece el lote de aves');
            $table->string('quantity')->comment('Cantidad de aves en el lote');
            $table->string('date_entry')->comment('Fecha de ingreso del lote de aves');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('poultry_lots');
    }
};
