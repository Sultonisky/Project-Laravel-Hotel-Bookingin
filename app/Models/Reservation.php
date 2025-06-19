<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
    use HasFactory;

    public $timestamps = true; // Mengaktifkan timestamps (created_at dan updated_at)
    protected $table = "reservations"; // Nama tabel
    // protected $guarded = ['id']; // Kolom yang tidak boleh diisi secara mass-assignment

    protected $fillable = [
        'booking_code',
        'guests_id',
        'rooms_id',
        'checkin_date',
        'checkout_date',
        'new_check_in',
        'new_check_out',
        'reschedule_count',
        'payment_method',
        'total_payment',
        'status',
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



    // public function getTotalPaymentAttribute()
    // {
    //     $checkin = Carbon::parse($this->checkin_date);
    //     $checkout = Carbon::parse($this->checkout_date);
    //     $duration = $checkout->diffInDays($checkin); // Menghitung jumlah hari menginap

    //     return $duration * $this->room->price; // Total pembayaran
    // }

    public function calculateTotalPayment($checkin_date, $checkout_date)
    {
        $days = Carbon::parse($checkout_date)->diffInDays(Carbon::parse($checkin_date));
        $roomPriceTotal = $days * $this->room->price;
        $tax = $roomPriceTotal * 0.01;
        $service = 50000;

        return $roomPriceTotal + $tax + $service;
    }
}
