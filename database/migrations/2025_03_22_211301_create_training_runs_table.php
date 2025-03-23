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
        Schema::create('training_runs', function (Blueprint $table) {
            $table->id();
            $table->decimal('distance', 8, 2);
            $table->decimal('speed', 5, 2)->nullable();
            $table->integer('duration')->nullable();
            $table->integer('pulse')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_runs');
    }
};
