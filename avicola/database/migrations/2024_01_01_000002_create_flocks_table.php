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
        Schema::create('flocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shed_id')->constrained('sheds')->onDelete('cascade');
            $table->string('name');
            $table->enum('type', ['engorde', 'ponedoras', 'reproductoras']);
            $table->date('entry_date');
            $table->integer('initial_bird_count');
            $table->integer('current_bird_count');
            $table->enum('status', ['activo', 'cerrado', 'vendido'])->default('activo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flocks');
    }
};
