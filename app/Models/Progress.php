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
        "id_kontrak_rencana",
        "id_kontrak_ruas_item",
        "nma_pekerjaan",
        "panjang",
        "titik_core",
        "penambahan",
        "pengurangan",
        "l_1",
        "l_2",
        "l_3",
        "l_4",
        "t1_1",
        "t1_2",
        "t1_3",
        "t2_1",
        "t2_2",
        "t2_3",
        "t3_1",
        "t3_2",
        "t3_3",
        "berat_jenis",
        "by_users"
    ];

    // untuk foreign key
    protected $with = [
        'toKontrakRencana',
        'toKontrakRuasItem',
    ];

    // untuk relasi ke tabel kontrak rencana
    public function toKontrakRencana()
    {
        return $this->belongsTo(KontrakRencana::class, 'id_kontrak_rencana', 'id_kontrak_rencana');
    }

    // untuk relasi ke tabel paket
    public function toKontrakRuasItem()
    {
        return $this->belongsTo(KontrakRuasItem::class, 'id_kontrak_ruas_item', 'id_kontrak_ruas_item');
    }
}
