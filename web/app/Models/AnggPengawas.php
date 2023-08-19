<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggPengawas extends Model
{
    use HasFactory;
    // untuk default tabel
    protected $table = 'angg_pengawas';
    // untuk default primary key
    protected $primaryKey = 'id_angg_pengawas';
    // untuk fillable
    protected $fillable = [
        'id_angg_pengawas',
        'id_kord_pengawas',
        'id_users',
        'telepon',
        'alamat',
        'by_users'
    ];

    // untuk relasi ke tabel kord pengawas
    public function toKordPengawas()
    {
        return $this->belongsTo(KordPengawas::class, 'id_kord_pengawas', 'id_kord_pengawas');
    }

    // untuk relasi ke tabel users
    public function toUser()
    {
        return $this->belongsTo(User::class, 'id_users', 'id_users');
    }
}
