<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Disease;
use App\Models\Title;
use Illuminate\Support\Str;

class DiseaseSeeder extends Seeder
{
    public function run(): void
    {
        $titles = Title::pluck('id')->toArray();

        $diseases = [
            ['name' => 'Anemia', 'description' => 'Condition marked by a deficiency of red blood cells.'],
            ['name' => 'Diabetes Mellitus', 'description' => 'Metabolic disorder resulting in high blood sugar.'],
            ['name' => 'Arthritis', 'description' => 'Inflammation of joints causing pain and stiffness.'],
        ];

        foreach ($diseases as $d) {
            $disease = Disease::create([
                'name' => $d['name'],
                'slug' => Str::slug($d['name']),
                'description' => $d['description'],
                'status' => 'published',
                'user_id' => 1,
            ]);

            foreach ($titles as $titleId) {
                $disease->titles()->attach($titleId, [
                    'heading' => $d['name'] . ' - ' . ucfirst(Title::find($titleId)->name),
                    'description' => "Detailed content about " . Title::find($titleId)->name . " for " . $d['name'],
                ]);
            }
        }
    }
}
