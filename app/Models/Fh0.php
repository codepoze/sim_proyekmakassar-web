<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fh0 extends Model
{
    use HasFactory;
    // untuk default tabel
    protected $table = 'fh0';
    // untuk default primary key
    protected $primaryKey = 'id_fh0';
    // untuk fillable
    protected $fillable = [
        "id_fh0",
        "id_kontrak_ruas_item",
        "nma_pekerjaan",
        "panjang",
        "titik_core",
        "l_1",
        "l_2",
        "l_3",
        "l_4",
        "tki_1",
        "tki_2",
        "tki_3",
        "tte_1",
        "tte_2",
        "tte_3",
        "tka_1",
        "tka_2",
        "tka_3",
        "berat_bersih",
        "by_users"
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
