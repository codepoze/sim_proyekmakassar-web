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
        'id_penyedia',
        'id_konsultan',
        'id_teknislap',
        'id_fund',
        'nma_paket',
        'pj_penyedia',
        'pj_konsultan',
        'no_spmk',
        'no_kontrak',
        'doc_kontrak',
        'tgl_kontrak_mulai',
        'tgl_kontrak_akhir',
        'thn_anggaran',
        'nil_pagu',
        'kd_rekening',
        'foto_lokasi',
        'laporan',
        'by_users'
    ];

    // untuk foreign key
    protected $with = [
        'toKegiatan',
        'toPenyedia',
        'toKonsultan',
        'toTeknislap',
        'toFund',
    ];

    // untuk relasi ke tabel kegiatan
    public function toKegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'id_kegiatan', 'id_kegiatan');
    }

    // untuk relasi ke tabel penyedia
    public function toPenyedia()
    {
        return $this->belongsTo(Penyedia::class, 'id_penyedia', 'id_penyedia');
    }

    // untuk relasi ke tabel konsultan
    public function toKonsultan()
    {
        return $this->belongsTo(Konsultan::class, 'id_konsultan', 'id_konsultan');
    }

    // untuk relasi ke tabel teknislap
    public function toTeknislap()
    {
        return $this->belongsTo(Teknislap::class, 'id_teknislap', 'id_teknislap');
    }

    // untuk relasi ke tabel fund
    public function toFund()
    {
        return $this->belongsTo(Fund::class, 'id_fund', 'id_fund');
    }

    // untuk relasi ke tabel ruas
    public function toPaketRuas()
    {
        return $this->hasMany(PaketRuas::class, 'id_paket', 'id_paket');
    }
}
