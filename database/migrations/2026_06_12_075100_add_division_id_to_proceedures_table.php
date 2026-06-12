<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('proceedures', function (Blueprint $table) {
            $table->foreignId('division_id')
                ->nullable()
                ->after('image_path')
                ->constrained('divisions')
                ->nullOnDelete();
        });

        // Migrate existing pivot table data to the new column
        if (Schema::hasTable('division_proceedure')) {
            $pivotData = DB::table('division_proceedure')->orderBy('id')->get();
            foreach ($pivotData as $row) {
                // Ensure we don't overwrite if multiple relations exist (keep first)
                DB::table('proceedures')
                    ->where('id', $row->proceedure_id)
                    ->whereNull('division_id')
                    ->update(['division_id' => $row->division_id]);
            }

            // Drop the pivot table
            Schema::dropIfExists('division_proceedure');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Recreate the pivot table
        Schema::create('division_proceedure', function (Blueprint $table) {
            $table->id();
            $table->foreignId('division_id')->constrained()->cascadeOnDelete();
            $table->foreignId('proceedure_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });

        // Copy data back from proceedures table to pivot table
        $proceedures = DB::table('proceedures')->whereNotNull('division_id')->get();
        foreach ($proceedures as $p) {
            DB::table('division_proceedure')->insert([
                'division_id' => $p->division_id,
                'proceedure_id' => $p->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Drop the column from proceedures table
        Schema::table('proceedures', function (Blueprint $table) {
            $table->dropForeign(['division_id']);
            $table->dropColumn('division_id');
        });
    }
};
