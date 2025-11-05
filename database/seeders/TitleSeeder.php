<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Title;
use Illuminate\Support\Str;

class TitleSeeder extends Seeder
{
    public function run(): void
    {
        $titles = [
            'Introduction',
            'Background',
            'Preparation',
            'Dosage',
            'Indications',
            'Contraindications',
        ];

        foreach ($titles as $title) {
            Title::firstOrCreate([
                'slug' => Str::slug($title),
            ], [
                'name' => $title,
                'description' => "Default description for $title",
            ]);
        }
    }
}
