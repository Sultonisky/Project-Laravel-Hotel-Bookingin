<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomCategory extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $table = "room_categories";
    protected $guarded = ['id'];

    public function rooms()
    {
        return $this->hasMany(Room::class, 'room_categories_id');
    }
}
