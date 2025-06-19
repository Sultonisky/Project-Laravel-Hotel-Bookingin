<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
<<<<<<< HEAD

use App\Models\User;
use App\Models\Guest;
use App\Models\RoomCategory;
use Illuminate\Database\Seeder;
use Database\Seeders\UsersSeeder;
use Database\Seeders\GuestsSeeder;
use Database\Seeders\FeaturesSeeder;
use Database\Seeders\RoomCategoriesSeeder;
=======
use App\Models\Item;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;
>>>>>>> 3d9f03e28f0f29b18fa29872119da2dbd9d6154d

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
<<<<<<< HEAD
        $this->call([
            UsersSeeder::class,
            GuestsSeeder::class,
            RoomCategoriesSeeder::class,
            RoomsSeeder::class,
            FeaturesSeeder::class
=======
        User::create([
            'nama' => 'admin123',
            'email' => 'admin123@gmail.com',
            'phone' => '08236543211',
            'password' => bcrypt('admin123'),
            'address' => 'Jakarta',
            'role' => 'admin',
            'foto' => '',
        ]);
        // User::create([
        //     'nama' => 'donatur123',
        //     'email' => 'donatur123@gmail.com',
        //     'phone' => '6288289210559',
        //     'password' => bcrypt('donatur123'),
        //     'address' => 'Jakarta',
        //     'role' => 'donatur',
        //     'foto' => '',
        // ]);
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
            'email' => 'yayasanjakartaberkah@gmail.com',
            'phone' => '00816543211',
            'password' => bcrypt('yayasana123'),
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
        Category::create([
            'name' => 'Jacket',
        ]);
        Category::create([
            'name' => 'Sepatu',
        ]);
        Category::create([
            'name' => 'Sandal',
        ]);

        Item::create([
            'user_id' => '1',
            'category_id' => '1',
            'name' => 'Celana Jeans Pria Wanita',
            'description' => 'Celana dengan kondisi bagus',
            'condition' => 'Bagus',
            'status' => 'tersedia',
            'foto' => ''
        ]);
        Item::create([
            'user_id' => '1',
            'category_id' => '2',
            'name' => 'Baju Olahraga',
            'description' => 'Baju dengan kondisi bagus',
            'condition' => 'Bagus',
            'status' => 'tersedia',
            'foto' => ''
        ]);
        Item::create([
            'user_id' => '1',
            'category_id' => '2',
            'name' => 'Baju Reguler Lengan Pendek',
            'description' => 'Baju dengan kondisi bagus',
            'condition' => 'Bagus',
            'status' => 'tersedia',
            'foto' => ''
        ]);
        Item::create([
            'user_id' => '1',
            'category_id' => '3',
            'name' => 'jacket Pria',
            'description' => 'jacket dengan kondisi bagus',
            'condition' => 'Bagus',
            'status' => 'tersedia',
            'foto' => ''
        ]);
        Item::create([
            'user_id' => '1',
            'category_id' => '4',
            'name' => 'Sepatu Putih Pria Wanita',
            'description' => 'Sepatu dengan kondisi bagus',
            'condition' => 'Bagus',
            'status' => 'tersedia',
            'foto' => ''
        ]);
        Item::create([
            'user_id' => '1',
            'category_id' => '5',
            'name' => 'Sandal Pria',
            'description' => 'Sandal dengan kondisi bagus',
            'condition' => 'Bagus',
            'status' => 'tersedia',
            'foto' => ''
>>>>>>> 3d9f03e28f0f29b18fa29872119da2dbd9d6154d
        ]);
    }
}
