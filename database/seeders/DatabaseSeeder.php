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
            'nama' => 'admin123',
            'email' => 'admin123@gmail.com',
            'phone' => '08236543211',
            'password' => bcrypt('admin123'),
            'address' => 'Jakarta',
            'role' => 'admin',
            'foto' => '',
        ]);
        User::create([
            'nama' => 'donatur123',
            'email' => 'donatur123@gmail.com',
            'phone' => '08176543211',
            'password' => bcrypt('donatur123'),
            'address' => 'Jakarta',
            'role' => 'donatur',
            'foto' => '',
        ]);
        User::create([
            'nama' => 'user123',
            'email' => 'user123@gmail.com',
            'phone' => '09876543211',
            'password' => bcrypt('user123'),
            'address' => 'Jakarta',
            'role' => 'penerima',
            'foto' => '',
        ]);
        User::create([
            'nama' => 'user_penerima',
            'email' => 'userpenerima@gmail.com',
            'phone' => '00816543211',
            'password' => bcrypt('penerima123'),
            'address' => 'Jakarta',
            'role' => 'penerima',
            'foto' => '',
        ]);

        Category::create([
            'name' => 'Celana',
        ]);
        Category::create([
            'name' => 'Baju',
        ]);
    }
}
