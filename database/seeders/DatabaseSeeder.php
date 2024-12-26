<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Guest;
use App\Models\User;
use App\Models\RoomCategory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Administrator Hotel',
            'email' => 'adminbookingin@gmail.com',
            'role' => '1',
            'status' => '1',
            'password' => bcrypt('admin123'),
            'hp' => '0812345678901',
            'foto' => '',
        ]);

        User::create([
            'name' => 'Resepsionis Hotel',
            'email' => 'resepsionisbookingin@gmail.com',
            'role' => '0',
            'status' => '1',
            'password' => bcrypt('resepsionis123'),
            'hp' => '0843215678901',
            'foto' => '',
        ]);
        Guest::create([
            'name' => 'Guest Data Bookingin (Test)',
            'email' => 'TestAcc@gmail.com',
            'no_hp' => '0854315678991',
            'foto' => '',
        ]);


        RoomCategory::create([
            'category_name' => 'Standart Room',
        ]);
        RoomCategory::create([
            'category_name' => 'Suite Room',
        ]);
        RoomCategory::create([
            'category_name' => 'Deluxe Room',
        ]);
        RoomCategory::create([
            'category_name' => 'Superior Room',
        ]);
        RoomCategory::create([
            'category_name' => 'Presindetial Room',
        ]);
        RoomCategory::create([
            'category_name' => 'Home Living Room',
        ]);
    }
}
