<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    public $timestamps = true; // Mengaktifkan timestamps (created_at dan updated_at)
    protected $table = "reservations"; // Nama tabel
    protected $guarded = ['id']; // Kolom yang tidak boleh diisi secara mass-assignment

    // Relasi ke RoomCategory (many-to-one)
    public function guest()
    {
        return $this->belongsTo(Guest::class, 'guests_id', 'id'); // Foreign key, Primary key
    }

    // Relasi ke Guest (many-to-one)
    public function room()
    {
        return $this->belongsTo(Room::class, 'rooms_id', 'id'); // Foreign key, Primary key
    }

    public function getTotalPaymentAttribute()
    {
        $checkin = \Carbon\Carbon::parse($this->tanggal_checkin);
        $checkout = \Carbon\Carbon::parse($this->tanggal_checkout);
        $duration = $checkout->diffInDays($checkin); // Menghitung jumlah hari menginap

        return $duration * $this->room->price; // Total pembayaran
    }
}
