<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;
    // untuk default tabel
    protected $table = 'kegiatan';
    // untuk default primary key
    protected $primaryKey = 'id_kegiatan';
    // untuk fillable
    protected $fillable = [
        'id_kegiatan',
        'id_pptk',
        'nama',
        'tgl',
        'by_users'
    ];

    // untuk foreign key
    protected $with = [
        'toPptk'
    ];

    // untuk relasi ke tabel pptk
    public function toPptk()
    {
        return $this->belongsTo(Pptk::class, 'id_pptk', 'id_pptk');
    }

    // untuk relasi ke tabel paket
    public function toPaket()
    {
        return $this->hasMany(Paket::class, 'id_kegiatan', 'id_kegiatan');
    }
}
