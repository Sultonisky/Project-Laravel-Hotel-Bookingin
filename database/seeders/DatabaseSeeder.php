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
        User::create([
            'name' => 'user Hotel',
            'email' => 'userbookingin@gmail.com',
            'role' => '2',
            'status' => '1',
            'password' => bcrypt('user123'),
            'hp' => '0812215678901',
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
            'number_of_rooms' => '10',
            'description' => 'Kamar dasar dengan fasilitas standar untuk tamu beranggaran terbatas.',
        ]);
        RoomCategory::create([
            'category_name' => 'Suite Room',
            'number_of_rooms' => '10',
            'description' => 'Kamar luas dengan ruang tamu terpisah, dirancang untuk kenyamanan dan privasi lebih.',
        ]);
        RoomCategory::create([
            'category_name' => 'Deluxe Room',
            'number_of_rooms' => '10',
            'description' => ' Kamar yang lebih luas dan mewah dibandingkan standar, dengan fasilitas tambahan seperti tempat tidur besar.',
        ]);
        RoomCategory::create([
            'category_name' => 'Superior Room',
            'number_of_rooms' => '5',
            'description' => 'Superior Room menawarkan kenyamanan lebih dengan fasilitas dan ukuran yang lebih baik dari kamar standar.',
        ]);
        RoomCategory::create([
            'category_name' => 'Presindetial Room',
            'number_of_rooms' => '5',
            'description' => 'kamar paling mewah dengan fasilitas premium seperti jacuzzi, ruang tamu besar, dan layanan eksklusif.',
        ]);
        RoomCategory::create([
            'category_name' => 'Home Living Room',
            'number_of_rooms' => '5',
            'description' => 'Kamar dengan konsep seperti rumah, dilengkapi dapur kecil dan ruang tamu untuk tamu yang menginap lama.',
        ]);
        RoomCategory::create([
            'category_name' => 'Junior Suite Room',
            'number_of_rooms' => '5',
            'description' => 'Junior Suite menggabungkan area tidur dan ruang tamu kecil dalam satu ruangan untuk kenyamanan ekstra.',
        ]);
        RoomCategory::create([
            'category_name' => 'Cabana Room',
            'number_of_rooms' => '3',
            'description' => 'kamar dekat kolam renang atau pantai dengan suasana santai dan akses langsung ke alam.',
        ]);
    }
}
