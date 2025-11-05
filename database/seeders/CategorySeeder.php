<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Classical Disease', 'fa_icon' => 'fas fa-book-medical'],
            ['name' => 'Commercial Classical Medicines', 'fa_icon' => 'fas fa-pills'],
            ['name' => 'Proprietary Medicines', 'fa_icon' => 'fas fa-capsules'],
            ['name' => 'Patent Medicines', 'fa_icon' => 'fas fa-file-medical'],
            ['name' => 'Modern Diseases', 'fa_icon' => 'fas fa-heartbeat'],
            ['name' => 'Ayurvedic Procedures', 'fa_icon' => 'fas fa-spa'],
        ];

        foreach ($categories as $c) {
            Category::firstOrCreate(['slug' => Str::slug($c['name'])], [
                'name' => $c['name'],
                'fa_icon' => $c['fa_icon'],
                'description' => "Default category for {$c['name']}",
            ]);
        }
    }
}
