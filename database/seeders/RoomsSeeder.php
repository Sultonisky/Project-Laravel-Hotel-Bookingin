<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoomsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rooms = [
            [
                'room_categories_id' => 1, // Standart Room
                'status' => 1, // Ready
                'room_name' => 'Standart Room 101',
                'price' => 300000,
                'foto' => 'backend\images\img-hotel\standart.jpg', // atau kamu bisa sesuaikan nama file gambar
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'room_categories_id' => 3, // Deluxe Room
                'status' => 1,
                'room_name' => 'Deluxe Room 201',
                'price' => 500000,
                'foto' => 'deluxe.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'room_categories_id' => 2, // Suite Room
                'status' => 1,
                'room_name' => 'Suite Room 301',
                'price' => 800000,
                'foto' => 'default.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'room_categories_id' => 7, // Junior Suite Room
                'status' => 1,
                'room_name' => 'Junior Suite Room 401',
                'price' => 650000,
                'foto' => 'default.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'room_categories_id' => 4, // Superior Room
                'status' => 1,
                'room_name' => 'Superior Room 501',
                'price' => 550000,
                'foto' => 'default.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'room_categories_id' => 6, // Home Living Room
                'status' => 1,
                'room_name' => 'Home Living Room 601',
                'price' => 750000,
                'foto' => 'default.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'room_categories_id' => 8, // Cabana Room
                'status' => 1,
                'room_name' => 'Cabana Room 701',
                'price' => 850000,
                'foto' => 'default.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'room_categories_id' => 5, // Presidential Room
                'status' => 1,
                'room_name' => 'Presidential Room 801',
                'price' => 1500000,
                'foto' => 'default.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        Room::insert($rooms);
    }
}
