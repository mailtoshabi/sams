<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Create therapeutic_differences table
        Schema::create('therapeutic_differences', function (Blueprint $table) {
            $table->id();
            $table->text('introduction')->nullable();
            $table->foreignId('medicine_1_id');
            $table->foreignId('medicine_2_id');
            $table->timestamps();

            $table->foreign('medicine_1_id')
                ->references('id')
                ->on('medicines')
                ->onDelete('cascade')
                ->name('td_medicine_1_fk');

            $table->foreign('medicine_2_id')
                ->references('id')
                ->on('medicines')
                ->onDelete('cascade')
                ->name('td_medicine_2_fk');
        });

        // Create therapeutic_difference_points table
        Schema::create('therapeutic_difference_points', function (Blueprint $table) {
            $table->id();
            $table->foreignId('therapeutic_difference_id');
            $table->text('medicine_1_description');
            $table->text('medicine_2_description');
            $table->integer('point_number')->default(0);
            $table->timestamps();

            $table->foreign('therapeutic_difference_id')
                ->references('id')
                ->on('therapeutic_differences')
                ->onDelete('cascade')
                ->name('tdp_td_id_fk');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('therapeutic_difference_points');
        Schema::dropIfExists('therapeutic_differences');
    }
};
