<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketRuas extends Model
{
    use HasFactory;
    // untuk default tabel
    protected $table = 'paket_ruas';
    // untuk default primary key
    protected $primaryKey = 'id_paket_ruas';
    // untuk fillable
    protected $fillable = [
        'id_paket_ruas',
        'id_paket',
        'nama',
        'by_users'
    ];

    // untuk foreign key
    protected $with = [
        'toPaket'
    ];

    // untuk relasi ke tabel paket
    public function toPaket()
    {
        return $this->belongsTo(Paket::class, 'id_paket', 'id_paket');
    }

    // untuk relasi ke tabel paket_ruas_item
    public function toPaketRuasItem()
    {
        return $this->hasMany(PaketRuasItem::class, 'id_paket_ruas', 'id_paket_ruas');
    }
}
