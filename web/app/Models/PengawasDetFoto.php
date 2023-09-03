<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengawasDetFoto extends Model
{
    use HasFactory;
    // untuk default tabel
    protected $table = 'pengawas_det_foto';
    // untuk default primary key
    protected $primaryKey = 'id_pengawas_det_foto';
    // untuk fillable
    protected $fillable = [
        'id_pengawas_det_foto',
        'id_pengawas',
        'foto'
    ];

    // untuk relasi ke tabel pengawas
    public function toPengawas()
    {
        return $this->belongsTo(Pengawas::class, 'id_pengawas', 'id_pengawas');
    }
}
