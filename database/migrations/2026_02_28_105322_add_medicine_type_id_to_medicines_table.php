<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('medicines', function (Blueprint $table) {
            $table->foreignId('medicine_type_id')
                ->nullable()
                ->after('id')
                ->constrained('medicine_types')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('medicines', function (Blueprint $table) {
            $table->dropForeign(['medicine_type_id']);
            $table->dropColumn('medicine_type_id');
        });
    }
};
