<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KontrakRuas extends Model
{
    use HasFactory;
    // untuk default tabel
    protected $table = 'kontrak_ruas';
    // untuk default primary key
    protected $primaryKey = 'id_kontrak_ruas';
    // untuk fillable
    protected $fillable = [
        'id_kontrak_ruas',
        'id_kontrak',
        'foto',
        'nama',
        'by_users'
    ];

    // untuk foreign key
    protected $with = [
        'toKontrak'
    ];

    // untuk relasi ke tabel kontrak
    public function toKontrak()
    {
        return $this->belongsTo(Kontrak::class, 'id_kontrak', 'id_kontrak');
    }

    // untuk relasi ke tabel paket_ruas_item
    public function toKontrakRuasItem()
    {
        return $this->hasMany(KontrakRuasItem::class, 'id_kontrak_ruas', 'id_kontrak_ruas');
    }
}
