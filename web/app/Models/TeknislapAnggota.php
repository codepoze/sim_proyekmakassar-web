<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeknislapAnggota extends Model
{
    use HasFactory;
    // untuk default tabel
    protected $table = 'teknislap_anggota';
    // untuk default primary key
    protected $primaryKey = 'id_teknislap_anggota';
    // untuk fillable
    protected $fillable = [
        'id_teknislap_anggota',
        'id_teknislap',
        'id_users',
        'telepon',
        'alamat',
        'by_users'
    ];

    // untuk relasi ke tabel teknislap
    public function toTeknislap()
    {
        return $this->belongsTo(Teknislap::class, 'id_teknislap', 'id_teknislap');
    }

    // untuk relasi ke tabel users
    public function toUser()
    {
        return $this->belongsTo(User::class, 'id_users', 'id_users');
    }
}
