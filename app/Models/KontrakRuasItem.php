<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KontrakRuasItem extends Model
{
    use HasFactory;
    // untuk default tabel
    protected $table = 'kontrak_ruas_item';
    // untuk default primary key
    protected $primaryKey = 'id_kontrak_ruas_item';
    // untuk fillable
    protected $fillable = [
        'id_kontrak_ruas_item',
        'id_kontrak_ruas',
        'id_ruas_item',
        'id_satuan',
        'volume',
        'harga_hps',
        'harga_kontrak',
        'by_users'
    ];

    // untuk foreign key
    protected $with = [
        'toKontrakRuas',
        'toRuasItem',
        'toSatuan'
    ];

    // untuk relasi ke tabel paket_ruas
    public function toKontrakRuas()
    {
        return $this->belongsTo(KontrakRuas::class, 'id_kontrak_ruas', 'id_kontrak_ruas');
    }

    // untuk relasi ke tabel ruas item
    public function toRuasItem()
    {
        return $this->belongsTo(RuasItem::class, 'id_ruas_item', 'id_ruas_item');
    }

    // untuk relasi ke tabel satuan
    public function toSatuan()
    {
        return $this->belongsTo(Satuan::class, 'id_satuan', 'id_satuan');
    }

    // untuk relasi ke tabel progress
    public function toProgress()
    {
        return $this->hasMany(Progress::class, 'id_kontrak_ruas_item', 'id_kontrak_ruas_item');
    }
}
