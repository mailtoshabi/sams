<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tables to update
        $tables = [
            'divisions',
            'chapters',
            'formulations',
            'medicines',
            'diseases',
            'proceedures',
        ];

        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                if (!Schema::hasColumn($table->getTable(), 'ayurveda_name')) {
                    $table->string('ayurveda_name')->nullable()->after('name');
                }
            });
        }
    }

    public function down(): void
    {
        $tables = [
            'divisions',
            'chapters',
            'formulations',
            'medicines',
            'diseases',
            'proceedures',
        ];

        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                if (Schema::hasColumn($table->getTable(), 'ayurveda_name')) {
                    $table->dropColumn('ayurveda_name');
                }
            });
        }
    }
};
