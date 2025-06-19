<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
<<<<<<< HEAD
            $table->string('name');
            $table->string('email')->unique();
            $table->enum('role', [0, 1, 2])->default(0); //0 = user, 1 = SuperAdmin, 2 = Resepsionis
            $table->boolean('status', [0, 1])->default(1); // 0 = belum aktif, 1 = aktif
            $table->string('password');
            $table->string('foto')->nullable();
=======
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('password');
            $table->text('address')->nullable();
            $table->enum('role', ['admin', 'penerima'])->default('penerima');
            $table->string('foto')->nullable();
            $table->rememberToken();
>>>>>>> 3d9f03e28f0f29b18fa29872119da2dbd9d6154d
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
