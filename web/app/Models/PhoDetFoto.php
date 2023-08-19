<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoDetFoto extends Model
{
    use HasFactory;
    // untuk default tabel
    protected $table = 'pho_det_foto';
    // untuk default primary key
    protected $primaryKey = 'id_pho_det_foto';
    // untuk fillable
    protected $fillable = [
        'id_pho_det_foto',
        'id_pho',
        'foto',
    ];

    // untuk relasi ke tabel pho
    public function toPho()
    {
        return $this->belongsTo(Pho::class, 'id_pho', 'id_pho');
    }
}
