<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Authors table
        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('designation')->nullable();
            $table->timestamps();
        });

        // Raw Drug Index table
        Schema::create('raw_drug_indices', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('local_name')->nullable();
            $table->string('sanskrit_name')->nullable();
            $table->string('botanical_name')->nullable();
            $table->string('part_used')->nullable();
            $table->timestamps();
        });

        // Articles table
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('heading');
            $table->foreignId('author_id');
            $table->longText('article');
            $table->timestamps();

            $table->foreign('author_id')
                ->references('id')
                ->on('authors')
                ->onDelete('cascade')
                ->name('articles_author_id_fk');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('articles');
        Schema::dropIfExists('raw_drug_indices');
        Schema::dropIfExists('authors');
    }
};
