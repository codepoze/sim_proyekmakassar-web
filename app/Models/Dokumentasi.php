<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumentasi extends Model
{
    use HasFactory;
    // untuk default tabel
    protected $table = 'dokumentasi';
    // untuk default primary key
    protected $primaryKey = 'id_dokumentasi';
    // untuk fillable
    protected $fillable = [
        "id_dokumentasi",
        "id_kontrak_ruas_item",
        "keterangan",
    ];

    // untuk foreign key
    protected $with = [
        'toKontrakRuasItem',
    ];

    // untuk relasi ke tabel paket
    public function toKontrakRuasItem()
    {
        return $this->belongsTo(KontrakRuasItem::class, 'id_kontrak_ruas_item', 'id_kontrak_ruas_item');
    }
}
