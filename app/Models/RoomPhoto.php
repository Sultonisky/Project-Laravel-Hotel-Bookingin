<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomPhoto extends Model
{
    public $timestamps = true;
    protected $table = 'room_photos';
    protected $guarded = ['id'];

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
}
