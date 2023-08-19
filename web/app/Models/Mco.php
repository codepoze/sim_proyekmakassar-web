<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mco extends Model
{
    use HasFactory;
    // untuk default tabel
    protected $table = 'mco';
    // untuk default primary key
    protected $primaryKey = 'id_mco';
    // untuk fillable
    protected $fillable = [
        'id_mco',
        'id_paket',
        'hasil_perhitungan',
        'volume',
        'foto',
        'doc',
        'by_users'
    ];

    // untuk relasi ke tabel paket
    public function toPaket()
    {
        return $this->belongsTo(Paket::class, 'id_paket', 'id_paket');
    }
}
