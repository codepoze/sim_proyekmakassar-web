<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;
    // untuk default tabel
    protected $table = 'pakets';
    // untuk default primary key
    protected $primaryKey = 'id_paket';
    // untuk fillable
    protected $fillable = [
        'id_paket',
        'id_kegiatan',
        'id_perusahaan',
        'id_kord_pengawas',
        'nama_paket',
        'nama_pekerjaan',
        'lama_pekerjaan',
        'nilai_kontrak',
        'nomor_kontrak',
        'nomor_spk',
        'nama_lokasi',
        'ruas_jalan',
        'nilai_peruas',
        'nilai_total_ruas',
        'titik_kordinat',
        'schedule',
        'foto_lokasi',
        'doc_administrasi',
        'doc_kontrak',
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

    // untuk relasi ke tabel kord pengawas
    public function toKordPengawas()
    {
        return $this->belongsTo(KordPengawas::class, 'id_kord_pengawas', 'id_kord_pengawas');
    }
}
