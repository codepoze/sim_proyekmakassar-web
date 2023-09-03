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
        'id_ruas',
        'nama',
        'tgl',
        'keterngan',
        'panjang',
        'lebar',
        'video',
        'foto',
        'by_users'
    ];

    // untuk relasi ke tabel ruas
    public function toRuas()
    {
        return $this->belongsTo(Ruas::class, 'id_ruas', 'id_ruas');
    }

    // untuk relasi ke tabel pengawas_det_foto
    public function toPengawasDetFoto()
    {
        return $this->hasMany(PengawasDetFoto::class, 'id_pengawas', 'id_pengawas');
    }
}
