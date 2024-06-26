<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kontrak extends Model
{
    use HasFactory;
    // untuk default tabel
    protected $table = 'kontrak';
    // untuk default primary key
    protected $primaryKey = 'id_kontrak';
    // untuk fillable
    protected $fillable = [
        'id_kontrak',
        'id_paket',
        'id_penyedia',
        'id_konsultan',
        'id_teknislap',
        'id_fund',
        'pj_penyedia',
        'pj_konsultan',
        'kd_rekening',
        'no_spmk',
        'tgl_spmk',
        'no_ba_mc0',
        'tgl_ba_mc0',
        'no_ba_kntb',
        'tgl_ba_kntb',
        'no_sppbj',
        'tgl_sppbj',
        'no_ba_rp2k',
        'tgl_ba_rp2k',
        'no_sp',
        'tgl_sp',
        'no_ba_plp',
        'tgl_ba_plp',
        'no_kontrak',
        'tgl_kontrak',
        'tgl_kontrak_mulai',
        'tgl_kontrak_akhir',
        'nil_kontrak',
        'nil_pagu',
        'thn_anggaran',
        'pembuat_kontrak',
        'laporan',
        'doc_kontrak',
        'foto_lokasi',
        'by_users',
    ];

    // untuk foreign key
    protected $with = [
        'toPaket',
        'toPenyedia',
        'toKonsultan',
        'toTeknislap',
        'toFund',
    ];

    // untuk relasi ke tabel paket
    public function toPaket()
    {
        return $this->belongsTo(Paket::class, 'id_paket', 'id_paket');
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

    // untuk relasi ke tabel kontrak ruas
    public function toKontrakRuas()
    {
        return $this->hasMany(KontrakRuas::class, 'id_kontrak', 'id_kontrak');
    }

    // untuk relasi ke tabel kontrak rencana
    public function toKontrakRencana()
    {
        return $this->hasMany(KontrakRencana::class, 'id_kontrak', 'id_kontrak');
    }

    // untuk relasi ke tabel adendum
    public function toAdendum()
    {
        return $this->hasMany(Adendum::class, 'id_kontrak', 'id_kontrak');
    }
}
