<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'name',
        'description',
        'condition',
        // 'address',
        // 'phone',
        'category_id',
        'donor_id',
        'status',
        'main_image',
        // 'images',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function donor()
    {
        return $this->belongsTo(User::class, 'donor_id');
    }

    public function claims()
    {
        return $this->hasMany(Claim::class);
    }

    public function images()
    {
        return $this->hasMany(ItemImage::class);
    }

    public function statusLogs()
    {
        return $this->hasMany(ItemStatusLog::class);
    }
}
