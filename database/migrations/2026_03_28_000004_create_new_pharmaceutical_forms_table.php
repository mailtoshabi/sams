<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Create pharmaceutical_forms table
        Schema::create('pharmaceutical_forms', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        // Create manufacturing_companies table
        Schema::create('manufacturing_companies', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        // Create new_pharmaceutical_forms table
        Schema::create('new_pharmaceutical_forms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pharmaceutical_form_id');
            $table->string('name');
            $table->timestamps();

            $table->foreign('pharmaceutical_form_id')
                ->references('id')
                ->on('pharmaceutical_forms')
                ->onDelete('cascade')
                ->name('npf_phf_id_fk');
        });

        // Create junction table for many-to-many relationship
        Schema::create('new_pharmaceutical_form_manufacturing_company', function (Blueprint $table) {
            $table->id();
            $table->foreignId('new_pharmaceutical_form_id');
            $table->foreignId('manufacturing_company_id');
            $table->timestamps();

            $table->foreign('new_pharmaceutical_form_id')
                ->references('id')
                ->on('new_pharmaceutical_forms')
                ->onDelete('cascade')
                ->name('npf_mfg_npf_id_fk');

            $table->foreign('manufacturing_company_id')
                ->references('id')
                ->on('manufacturing_companies')
                ->onDelete('cascade')
                ->name('npf_mfg_mc_id_fk');

            $table->unique(['new_pharmaceutical_form_id', 'manufacturing_company_id'], 'npf_mfg_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('new_pharmaceutical_form_manufacturing_company');
        Schema::dropIfExists('new_pharmaceutical_forms');
        Schema::dropIfExists('manufacturing_companies');
        Schema::dropIfExists('pharmaceutical_forms');
    }
};
