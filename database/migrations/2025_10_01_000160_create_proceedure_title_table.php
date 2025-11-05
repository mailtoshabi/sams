<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('proceedure_title', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proceedure_id')->constrained()->cascadeOnDelete();
            $table->foreignId('title_id')->constrained()->cascadeOnDelete();
            $table->string('heading')->nullable();
            $table->text('description')->nullable();
            $table->string('image_path')->nullable();
            $table->timestamps();
            $table->unique(['proceedure_id','title_id']);
        });
    }
    public function down(): void { Schema::dropIfExists('proceedure_title'); }
};
