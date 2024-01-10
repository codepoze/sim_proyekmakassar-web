<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdendumRuasItem extends Model
{
    use HasFactory;
    // untuk default tabel
    protected $table = 'adendum_ruas_item';
    // untuk default primary key
    protected $primaryKey = 'id_adendum_ruas_item';
    // untuk fillable
    protected $fillable = [
        'id_adendum_ruas_item',
        'id_adendum_ruas',
        'id_satuan',
        'nama',
        'volume',
        'harga_hps',
        'harga_kontrak',
        'by_users'
    ];

    // untuk foreign key
    protected $with = [
        'toAdendumRuas',
        'toSatuan'
    ];

    // untuk relasi ke tabel adendum_ruas
    public function toAdendumRuas()
    {
        return $this->belongsTo(AdendumRuas::class, 'id_adendum_ruas', 'id_adendum_ruas');
    }

    // untuk relasi ke tabel satuan
    public function toSatuan()
    {
        return $this->belongsTo(Satuan::class, 'id_satuan', 'id_satuan');
    }
}
