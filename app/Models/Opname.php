<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opname extends Model
{
    use HasFactory;
    // untuk default tabel
    protected $table = 'opname';
    // untuk default primary key
    protected $primaryKey = 'id_opname';
    // untuk fillable
    protected $fillable = [
        "id_opname",
        "id_kontrak_ruas_item",
        "file",
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
