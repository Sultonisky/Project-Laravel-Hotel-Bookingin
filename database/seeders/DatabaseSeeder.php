<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Guest;
use App\Models\RoomCategory;
use Illuminate\Database\Seeder;
use Database\Seeders\UsersSeeder;
use Database\Seeders\GuestsSeeder;
use Database\Seeders\FeaturesSeeder;
use Database\Seeders\RoomCategoriesSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UsersSeeder::class,
            GuestsSeeder::class,
            RoomCategoriesSeeder::class,
            RoomsSeeder::class,
            FeaturesSeeder::class
        ]);
    }
}
