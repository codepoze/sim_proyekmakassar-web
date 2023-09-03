<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ph0 extends Model
{
    use HasFactory;
    // untuk default tabel
    protected $table = 'ph0';
    // untuk default primary key
    protected $primaryKey = 'id_ph0';
    // untuk fillable
    protected $fillable = [
        'id_ph0',
        'id_ruas',
        'tgl',
        'video',
        'doc',
        'by_users'
    ];

    // untuk relasi ke tabel ruas
    public function toRuas()
    {
        return $this->belongsTo(Ruas::class, 'id_ruas', 'id_ruas');
    }

    // untuk relasi ke tabel ph0_det_foto
    public function toPh0DetFoto()
    {
        return $this->hasMany(Ph0DetFoto::class, 'id_ph0', 'id_ph0');
    }
}
