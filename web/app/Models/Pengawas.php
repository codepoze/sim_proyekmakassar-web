<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengawas extends Model
{
    use HasFactory;
    // untuk default tabel
    protected $table = 'pengawas';
    // untuk default primary key
    protected $primaryKey = 'id_pengawas';
    // untuk fillable
    protected $fillable = [
        'id_pengawas',
        'id_paket',
        'tgl',
        'nama',
        'keterangan',
        'volume',
        'foto',
        'video',
        'doc',
        'by_users'
    ];

    // untuk relasi ke tabel paket
    public function toPaket()
    {
        return $this->belongsTo(Paket::class, 'id_paket', 'id_paket');
    }
}
