<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Administrator Hotel',
            'email' => 'adminbookingin@gmail.com',
            'role' => '1',
            'status' => '1',
            'password' => bcrypt('admin123'),
            'foto' => '',
        ]);
        User::create([
            'name' => 'Resepsionis Hotel',
            'email' => 'resepsionis@gmail.com',
            'role' => '2',
            'status' => '1',
            'password' => bcrypt('resepsionis123'),
            'foto' => '',
        ]);

        User::create([
            'name' => 'user Hotel',
            'email' => 'userbookingin@gmail.com',
            'role' => '0',
            'status' => '1',
            'password' => bcrypt('user123'),
            'foto' => '',
        ]);

        User::create([
            'name' => 'user1',
            'email' => 'user1@gmail.com',
            'role' => '0',
            'status' => '1',
            'password' => bcrypt('user123'),
            'foto' => '',
        ]);
    }
}
