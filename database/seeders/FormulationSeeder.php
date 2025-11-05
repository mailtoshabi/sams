<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Formulation;
use Illuminate\Support\Str;

class FormulationSeeder extends Seeder
{
    public function run(): void
    {
        $formulations = [
            'Arishta Kalpana',
            'Arka Kalpana',
            'Avacurnana Kalpana',
            'Asava Kalpana',
            'Bhasma Kalpana',
        ];

        foreach ($formulations as $name) {
            Formulation::updateOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => $name, 'description' => 'Description for ' . $name]
            );
        }
    }
}

