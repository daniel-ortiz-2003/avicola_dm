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
        Schema::create('daily_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('flock_id')->constrained('flocks')->onDelete('cascade');
            $table->date('record_date');
            $table->integer('mortality_count')->default(0);
            $table->decimal('average_weight_gr', 8, 2)->nullable();
            $table->decimal('feed_consumed_kg', 8, 2)->nullable();
            $table->decimal('water_consumed_lt', 8, 2)->nullable();
            $table->text('observations')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_records');
    }
};
