<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // untuk default tabel
    protected $table = 'users';
    // untuk default id
    protected $primaryKey = 'id_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_users',
        'id_role',
        'nama',
        'email',
        'active',
        'username',
        'password',
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
    ];

    // untuk relasi ke tabel role
    public function toRole()
    {
        return $this->belongsTo(Role::class, 'id_role', 'id_role');
    }

    // untuk relasi ke tabel pptk
    public function toPptk()
    {
        return $this->belongsTo(Pptk::class, 'id_users', 'id_users');
    }
}
