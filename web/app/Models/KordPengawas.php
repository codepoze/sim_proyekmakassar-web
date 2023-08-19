<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KordPengawas extends Model
{
    use HasFactory;
    // untuk default tabel
    protected $table = 'kord_pengawas';
    // untuk default primary key
    protected $primaryKey = 'id_kord_pengawas';
    // untuk fillable
    protected $fillable = [
        'id_kord_pengawas',
        'id_users',
        'telepon',
        'alamat',
        'by_users'
    ];

    // untuk relasi ke tabel users
    public function toUser()
    {
        return $this->belongsTo(User::class, 'id_users', 'id_users');
    }
}
