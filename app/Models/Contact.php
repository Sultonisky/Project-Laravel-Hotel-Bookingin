<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = true; // Mengaktifkan timestamps (created_at dan updated_at)
    protected $table = "contacts"; // Nama tabel
    protected $guarded = ['id']; // Kolom yang tidak boleh diisi secara mass-assignment

    protected $fillable = [
        'users_id',
        'name',
        'email',
        'messages',
        'created_at',
        'updated_at',

    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'users_id', 'id'); // Foreign key, Primary key
    }
}
