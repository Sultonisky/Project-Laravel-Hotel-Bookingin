<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    public function items() // relasi ke model/tabel items
    {
        return $this->hasMany(Item::class); // one-to-many (1 category bisa banyak items)
    }
}
