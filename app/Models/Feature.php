<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;

    public $timestamps = true; // Mengaktifkan timestamps (created_at dan updated_at)
    protected $table = "features"; // Nama tabel
    protected $guarded = ['id']; // Kolom yang tidak boleh diisi secara mass-assignment

    protected $fillable = [
        'name',
        'created_at',
        'updated_at',

    ];

    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'feature_room', 'feature_id', 'room_id');
    }
}
