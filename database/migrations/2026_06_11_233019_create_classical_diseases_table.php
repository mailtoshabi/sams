<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('classical_diseases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('division_id')->constrained()->cascadeOnDelete();
            $table->foreignId('chapter_id')->constrained()->cascadeOnDelete();
            $table->foreignId('medicine_type_id')->constrained()->cascadeOnDelete();
            $table->foreignId('formulation_id')->constrained()->cascadeOnDelete();
            $table->foreignId('medicine_id')->constrained()->cascadeOnDelete();

            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->timestamps();

            // Ensure unique mapping
            $table->unique(
                ['division_id', 'chapter_id', 'medicine_type_id', 'formulation_id', 'medicine_id'],
                'classical_diseases_unique'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classical_diseases');
    }
};
