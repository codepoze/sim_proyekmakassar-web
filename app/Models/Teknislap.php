<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teknislap extends Model
{
    use HasFactory;
    // untuk default tabel
    protected $table = 'teknislap';
    // untuk default primary key
    protected $primaryKey = 'id_teknislap';
    // untuk fillable
    protected $fillable = [
        'id_teknislap',
        'id_users',
        'telepon',
        'alamat',
        'by_users'
    ];

    // untuk relasi foreign key
    protected $with = [
        'toUser'
    ];

    // untuk relasi ke tabel users
    public function toUser()
    {
        return $this->belongsTo(User::class, 'id_users', 'id_users');
    }
}
