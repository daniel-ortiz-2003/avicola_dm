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
        Schema::create('inputs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('poultry_lots_id')->constrained('poultry_lots')->onDelete('cascade')->onUpdate('cascade')->comment('ID del lote de aves al que pertenece el insumo');
            $table->string('name')->comment('Nombre del insumo');
            $table->integer('quantity')->comment('Cantidad del insumo');
            $table->integer('unit_price')->comment('Precio unitario del insumo');
            $table->date('date_entry')->comment('Fecha de ingreso del insumo');
            $table->date('date_expiration')->nullable()->comment('Fecha de vencimiento del insumo');
            $table->string('type')->comment('Tipo de insumo (general, alimento, medicamento, etc.)');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inputs');
    }
};
