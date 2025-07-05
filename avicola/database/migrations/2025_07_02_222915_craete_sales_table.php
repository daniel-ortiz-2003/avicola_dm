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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('poultry_lots_id')->constrained('poultry_lots')->onDelete('cascade')->onUpdate('cascade')->comment('ID del lote de aves al que pertenece la venta');
            $table->integer('quantity')->comment('Cantidad de aves vendidas');
            $table->decimal('price', 10, 2)->comment('Precio de venta de las aves');
            $table->date('date')->comment('Fecha de la venta');
            $table->string('type')->comment('Tipo de venta (fiado, contado, etc.)');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
