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
        Schema::create('modern_disease_proceedure', function (Blueprint $table) {
            $table->id();
            $table->foreignId('modern_disease_id')->constrained()->cascadeOnDelete();
            $table->foreignId('proceedure_id')->constrained()->cascadeOnDelete();
            $table->text('description')->nullable();
            $table->timestamps();

            // Ensure unique mapping
            $table->unique(['modern_disease_id', 'proceedure_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modern_disease_proceedure');
    }
};
