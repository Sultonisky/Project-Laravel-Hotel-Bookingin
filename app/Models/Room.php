<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    use HasFactory;

    public $timestamps = true; // Mengaktifkan timestamps (created_at dan updated_at)
    protected $table = "rooms"; // Nama tabel
    protected $guarded = ['id']; // Kolom yang tidak boleh diisi secara mass-assignment

    // Relasi ke RoomCategory (many-to-one)
    public function category()
    {
        return $this->belongsTo(RoomCategory::class, 'room_categories_id', 'id'); // Foreign key, Primary key
    }

    public function photos()
    {
        return $this->hasMany(RoomPhoto::class, 'rooms_id'); // Mengacu pada foreign key "rooms_id"
    }


    // // Relasi ke Guest (many-to-one)
    // public function guest()
    // {
    //     return $this->belongsTo(Guest::class, 'guests_id', 'id'); // Foreign key, Primary key
    // }
}
