<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adendum extends Model
{
    use HasFactory;
    // untuk default tabel
    protected $table = 'adendum';
    // untuk default primary key
    protected $primaryKey = 'id_adendum';
    // untuk fillable
    protected $fillable = [
        'id_adendum',
        'id_kontrak',
        'no_adendum',
        'tgl_adendum',
        'jenis',
        'nil_adendum_kontrak',
        'tgl_adendum_mulai',
        'tgl_adendum_akhir',
        'by_users',
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

    // untuk relasi ke tabel adendum_ruas
    public function toAdendumRuas()
    {
        return $this->hasMany(AdendumRuas::class, 'id_adendum', 'id_adendum');
    }
}
