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
        Schema::create('egg_productions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('flock_id')->constrained('flocks')->onDelete('cascade');
            $table->date('collection_date');
            $table->integer('total_eggs');
            $table->integer('first_quality_eggs')->default(0);
            $table->integer('second_quality_eggs')->default(0);
            $table->integer('broken_eggs')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('egg_productions');
    }
};
