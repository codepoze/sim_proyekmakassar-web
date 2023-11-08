<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketRuasItem extends Model
{
    use HasFactory;
    // untuk default tabel
    protected $table = 'paket_ruas_item';
    // untuk default primary key
    protected $primaryKey = 'id_paket_ruas_item';
    // untuk fillable
    protected $fillable = [
        'id_paket_ruas_item',
        'id_paket_ruas',
        'id_satuan',
        'nama',
        'volume',
        'harga_hps',
        'harga_kontrak',
        'by_users'
    ];

    // untuk foreign key
    protected $with = [
        'toPaketRuas',
        'toSatuan'
    ];

    // untuk relasi ke tabel paket_ruas
    public function toPaketRuas()
    {
        return $this->belongsTo(PaketRuas::class, 'id_paket_ruas', 'id_paket_ruas');
    }

    // untuk relasi ke tabel satuan
    public function toSatuan()
    {
        return $this->belongsTo(Satuan::class, 'id_satuan', 'id_satuan');
    }
}
