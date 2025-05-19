<?php

namespace Database\Seeders;

use App\Models\Guest;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GuestsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Guest::create([
            'name' => 'Guest Data Bookingin (Test)',
            'email' => 'TestAcc@gmail.com',
            'no_hp' => '0854315678991',
            'foto' => '',
        ]);
    }
}
