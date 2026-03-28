<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('commercial_oushadha_kalpanas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('formulation_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('formulation_id')
                ->references('id')
                ->on('formulations')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('commercial_oushadha_kalpanas');
    }
};
