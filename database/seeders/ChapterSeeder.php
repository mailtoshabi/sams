<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Chapter;
use App\Models\Division;
use Illuminate\Support\Str;

class ChapterSeeder extends Seeder
{
    public function run(): void
    {
        $divisions = Division::all();

        for ($i = 1; $i <= 3; $i++) {
                $name = "Chapter $i - ";
                Chapter::updateOrCreate(
                    [

                        'name' => $name,
                        'slug' => $name
                    ],
                    [
                        'description' => 'Details about ' . $name
                    ]
                );
            }
    }
}
