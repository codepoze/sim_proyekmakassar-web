<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruas extends Model
{
    use HasFactory;
    // untuk default tabel
    protected $table = 'ruas';
    // untuk default primary key
    protected $primaryKey = 'id_ruas';
    // untuk fillable
    protected $fillable = [
        'id_ruas',
        'id_paket',
        'nilai_ruas',
        'lat',
        'long',
        'by_users'
    ];

    // untuk relasi ke tabel paket
    public function toPaket()
    {
        return $this->belongsTo(Paket::class, 'id_paket', 'id_paket');
    }
}
