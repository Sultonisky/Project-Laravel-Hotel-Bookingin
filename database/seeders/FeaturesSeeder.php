<?php

namespace Database\Seeders;

use App\Models\Feature;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FeaturesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $features = [
            'Free WiFi',
            'Air Conditioner',
            'Swimming Pool',
            'Gym Access',
            'Breakfast Included',
            'Room Service',
            'Sea View',
            'Flat Screen TV'
        ];

        foreach ($features as $feature) {
            Feature::create([
                'name' => $feature,
            ]);
        }
    }
}
