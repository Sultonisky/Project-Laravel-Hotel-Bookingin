<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ItemStatusLog;

class Item extends Model
{
    protected $fillable = [
        'name',
        'description',
        'condition',
        'category_id',
        'user_id',
        'status',
        'foto',
    ];

    public function category() // relasi ke model/tabel category
    {
        return $this->belongsTo(Category::class); // many-to-one
    }

    public function user() // relasi ke model/tabel user
    {
        return $this->belongsTo(User::class, 'user_id'); // many-to-one
    }

    public function claims() // relasi ke model/tabel claim
    {
        return $this->hasMany(Claim::class); // one-to-many
    }
}
