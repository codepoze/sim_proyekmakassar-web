<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pho extends Model
{
    use HasFactory;
    // untuk default tabel
    protected $table = 'pho';
    // untuk default primary key
    protected $primaryKey = 'id_pho';
    // untuk fillable
    protected $fillable = [
        'id_pho',
        'id_paket',
        'tgl',
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
