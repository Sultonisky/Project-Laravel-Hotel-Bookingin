<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guest extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'email', 'no_hp', 'foto'];

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'guests_id');
    }
}
