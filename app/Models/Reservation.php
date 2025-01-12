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

    protected $fillable = [
        'guests_id',
        'rooms_id',
        'checkin_date',
        'checkout_date',
        'new_check_in',
        'new_check_out',
        'reschedule_count',
        'payment_method',
        'total_payment',
        'created_by',
        'updated_by',

    ];

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

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }



    public function getTotalPaymentAttribute()
    {
        $checkin = \Carbon\Carbon::parse($this->checkin_date);
        $checkout = \Carbon\Carbon::parse($this->checkout_date);
        $duration = $checkout->diffInDays($checkin); // Menghitung jumlah hari menginap

        return $duration * $this->room->price; // Total pembayaran
    }
}
