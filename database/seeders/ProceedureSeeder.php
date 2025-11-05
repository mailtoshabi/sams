<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Proceedure;
use App\Models\Title;
use Illuminate\Support\Str;

class ProceedureSeeder extends Seeder
{
    public function run(): void
    {
        $titles = Title::pluck('id')->toArray();

        $procedures = [
            ['name' => 'Abhyanga', 'description' => 'Full body oil massage to promote circulation and detoxification.'],
            ['name' => 'Snehapana', 'description' => 'Internal oleation therapy before Panchakarma.'],
            ['name' => 'Swedana', 'description' => 'Herbal steam therapy for toxin elimination.'],
        ];

        foreach ($procedures as $p) {
            $proceedure = Proceedure::create([
                'name' => $p['name'],
                'slug' => Str::slug($p['name']),
                'description' => $p['description'],
                'status' => 'published',
                'user_id' => 1,
            ]);

            foreach ($titles as $titleId) {
                $proceedure->titles()->attach($titleId, [
                    'heading' => $p['name'] . ' - ' . ucfirst(Title::find($titleId)->name),
                    'description' => "Ayurvedic explanation for " . Title::find($titleId)->name . " of " . $p['name'],
                ]);
            }
        }
    }
}
