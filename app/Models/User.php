<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
<<<<<<< HEAD
        'name',
        'email',
        'role',
        'status',
        'password',
=======
        'nama',
        'email',
        'phone',
        'password',
        'address',
        'role',
>>>>>>> 3d9f03e28f0f29b18fa29872119da2dbd9d6154d
        'foto',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
<<<<<<< HEAD
        'role' => 'integer',

    ];

    public function reservationsCreated()
    {
        return $this->hasMany(Reservation::class, 'created_by');
    }

    public function reservationsUpdated()
    {
        return $this->hasMany(Reservation::class, 'updated_by');
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class, 'users_id');
=======
    ];

    // Relasi: user sebagai donor
    public function donatedItems()
    {
        return $this->hasMany(Item::class, 'user_id');
    }

    // Relasi: user sebagai pengklaim
    public function claims()
    {
        return $this->hasMany(Claim::class);
    }

    // Relasi: user untuk chat ngasih feedback
    public function messages()
    {
        return $this->hasMany(Message::class);
>>>>>>> 3d9f03e28f0f29b18fa29872119da2dbd9d6154d
    }
}
