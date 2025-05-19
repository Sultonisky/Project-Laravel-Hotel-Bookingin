<?php

namespace Database\Seeders;

use App\Models\RoomCategory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoomCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RoomCategory::insert([
            [
                'category_name' => 'Standart Room',
                'capacity' => '2',
                'bed_size' => 'Double Size Bed',
                'number_of_rooms' => '10',
                'description' => 'Kamar dasar dengan fasilitas standar untuk tamu beranggaran terbatas.',
            ],
            [
                'category_name' => 'Suite Room',
                'capacity' => '2',
                'bed_size' => 'Twin Bed size',
                'number_of_rooms' => '10',
                'description' => 'Kamar luas dengan ruang tamu terpisah, dirancang untuk kenyamanan dan privasi lebih.',
            ],
            [
                'category_name' => 'Deluxe Room',
                'capacity' => '2',
                'bed_size' => 'Queen Size Bed',
                'number_of_rooms' => '10',
                'description' => 'Kamar yang lebih luas dan mewah dibandingkan standar, dengan fasilitas tambahan seperti tempat tidur besar.',
            ],
            [
                'category_name' => 'Superior Room',
                'capacity' => '2',
                'bed_size' => 'King Size Bed',
                'number_of_rooms' => '5',
                'description' => 'Superior Room menawarkan kenyamanan lebih dengan fasilitas dan ukuran yang lebih baik dari kamar standar.',
            ],
            [
                'category_name' => 'Presindetial Room',
                'capacity' => '2',
                'bed_size' => 'Super King Size Bed',
                'number_of_rooms' => '5',
                'description' => 'kamar paling mewah dengan fasilitas premium seperti jacuzzi, ruang tamu besar, dan layanan eksklusif.',
            ],
            [
                'category_name' => 'Home Living Room',
                'capacity' => '4',
                'bed_size' => 'Queen Size Bed, Baby Cot, Extra Bed',
                'number_of_rooms' => '5',
                'description' => 'Kamar dengan konsep seperti rumah, dilengkapi dapur kecil dan ruang tamu untuk tamu yang menginap lama.',
            ],
            [
                'category_name' => 'Junior Suite Room',
                'capacity' => '2',
                'bed_size' => 'Super King Size',
                'number_of_rooms' => '5',
                'description' => 'Junior Suite menggabungkan area tidur dan ruang tamu kecil dalam satu ruangan untuk kenyamanan ekstra.',
            ],
            [
                'category_name' => 'Cabana Room',
                'capacity' => '2',
                'bed_size' => 'Queen Size Bed',
                'number_of_rooms' => '3',
                'description' => 'kamar dekat kolam renang atau pantai dengan suasana santai dan akses langsung ke alam.',
            ],
        ]);
    }
}
