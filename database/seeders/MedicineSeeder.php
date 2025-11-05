<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Medicine;
use App\Models\Title;
use Illuminate\Support\Str;

class MedicineSeeder extends Seeder
{
    public function run(): void
    {
        $titles = Title::pluck('id')->toArray();

        $medicines = [
            ['name' => 'Abhayarishta 1', 'description' => 'Classical Ayurvedic medicine for digestive issues.'],
            ['name' => 'Amrtarishta', 'description' => 'Used for immune system and general health.'],
            ['name' => 'Arjunarishta', 'description' => 'Traditional remedy for heart health.'],
        ];

        foreach ($medicines as $m) {
            $medicine = Medicine::create([
                'name' => $m['name'],
                'slug' => Str::slug($m['name']),
                'description' => $m['description'],
                'status' => 'published',
                'user_id' => 1,
            ]);

            // Attach random titles with pivot data
            foreach ($titles as $titleId) {
                $medicine->titles()->attach($titleId, [
                    'heading' => $m['name'] . ' - ' . ucfirst(Title::find($titleId)->name),
                    'description' => "Detailed explanation of " . Title::find($titleId)->name . " for " . $m['name'],
                ]);
            }
        }
    }
}
