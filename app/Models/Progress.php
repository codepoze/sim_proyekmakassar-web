<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    use HasFactory;
    // untuk default tabel
    protected $table = 'progress';
    // untuk default primary key
    protected $primaryKey = 'id_progress';
    // untuk fillable
    protected $fillable = [
        "id_progress",
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
