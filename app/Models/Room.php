<?php

namespace App\Models;

use App\Models\Feature;
use App\Models\RoomPhoto;
use App\Models\Reservation;
use App\Models\RoomCategory;
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

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'rooms_id');
    }

    public function photos()
    {
        return $this->hasMany(RoomPhoto::class, 'room_id'); // Mengacu pada foreign key "rooms_id"
    }

    public function features()
    {
        return $this->belongsToMany(Feature::class, 'feature_room', 'room_id', 'feature_id');
    }
}
