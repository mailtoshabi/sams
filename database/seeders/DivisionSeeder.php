<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Division;
use Illuminate\Support\Str;

class DivisionSeeder extends Seeder
{
    public function run(): void
    {
        $divisions = [
            'General Medicine',
            'Surgical Treatment',
            'Ophthalmology & ENT',
            'Pediatrics',
            'Gynaecology, Obstetrics & Postnatal Care',
            'Psychiatry',
            'Toxicology',
            'Geriatrics & Rejuvenation',
            'Aphrodisiac Treatment',
        ];

        foreach ($divisions as $name) {
            Division::updateOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => $name, 'description' => 'Division covering ' . $name]
            );
        }
    }
}
