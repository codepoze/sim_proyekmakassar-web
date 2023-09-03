<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;
    // untuk default tabel
    protected $table = 'paket';
    // untuk default primary key
    protected $primaryKey = 'id_paket';
    // untuk fillable
    protected $fillable = [
        'id_paket',
        'id_kegiatan',
        'id_perusahaan',
        'id_teknislap',
        'no_spmk',
        'no_kontrak',
        'nil_kontrak',
        'waktu_kontrak',
        'doc_kontrak',
        'lokasi_pekerjaan',
        'schedule',
        'foto_lokasi',
        'laporan',
        'by_users'
    ];

    // untuk relasi ke tabel kegiatan
    public function toKegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'id_kegiatan', 'id_kegiatan');
    }

    // untuk relasi ke tabel perusahaan
    public function toPerusahaan()
    {
        return $this->belongsTo(Perusahaan::class, 'id_perusahaan', 'id_perusahaan');
    }

    // untuk relasi ke tabel teknislap
    public function toTeknislap()
    {
        return $this->belongsTo(Teknislap::class, 'id_teknislap', 'id_teknislap');
    }
}
