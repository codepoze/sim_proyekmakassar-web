<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mc0 extends Model
{
    use HasFactory;
    // untuk default tabel
    protected $table = 'mc0';
    // untuk default primary key
    protected $primaryKey = 'id_mc0';
    // untuk fillable
    protected $fillable = [
        'id_mc0',
        'id_ruas',
        'cc0',
        'volume_mc0',
        'doc',
        'by_users'
    ];

    // untuk relasi ke tabel ruas
    public function toRuas()
    {
        return $this->belongsTo(Ruas::class, 'id_ruas', 'id_ruas');
    }

    // untuk relasi ke tabel mc0_det_foto
    public function toMc0DetFoto()
    {
        return $this->hasMany(Mc0DetFoto::class, 'id_mc0', 'id_mc0');
    }
}
