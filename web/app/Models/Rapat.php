<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rapat extends Model
{
    use HasFactory;
    // untuk default tabel
    protected $table = 'rapat';
    // untuk default primary key
    protected $primaryKey = 'id_rapat';
    // untuk fillable
    protected $fillable = [
        'id_rapat',
        'id_paket',
        'nama',
        'notulen',
        'foto_kegiatan',
        'foto_surat',
        'foto_daftar_hadir',
        'by_users'
    ];

    // untuk relasi ke tabel paket
    public function toPaket()
    {
        return $this->belongsTo(Paket::class, 'id_paket', 'id_paket');
    }
}
