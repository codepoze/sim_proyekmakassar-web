<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mc0DetFoto extends Model
{
    use HasFactory;
    // untuk default tabel
    protected $table = 'mc0_det_foto';
    // untuk default primary key
    protected $primaryKey = 'id_mc0_det_foto';
    // untuk fillable
    protected $fillable = [
        'id_mc0_det_foto',
        'id_mc0',
        'foto'
    ];

    // untuk relasi ke tabel mc0
    public function toMc0()
    {
        return $this->belongsTo(Mc0::class, 'id_mc0', 'id_mc0');
    }
}
