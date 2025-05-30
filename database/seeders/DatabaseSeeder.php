<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'nama' => 'user123',
            'email' => 'user123@gmail.com',
            'phone' => '09876543211',
            'password' => bcrypt('user123'),
            'address' => 'Jakarta',
            'role' => 'donatur',
            'foto' => '',
        ]);

        Category::create([
            'name' => 'Celana',
        ]);
    }
}
