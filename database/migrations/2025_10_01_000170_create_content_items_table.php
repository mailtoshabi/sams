<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('content_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('division_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('chapter_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('formulation_id')->nullable()->constrained()->nullOnDelete();

            $table->foreignId('medicine_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('disease_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('proceedure_id')->nullable()->constrained()->nullOnDelete();

            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->enum('status',['draft','published'])->default('draft');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('content_items'); }
};
