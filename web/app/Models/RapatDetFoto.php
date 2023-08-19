<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RapatDetFoto extends Model
{
    use HasFactory;
    // untuk default tabel
    protected $table = 'rapat_det_foto';
    // untuk default primary key
    protected $primaryKey = 'id_rapat_det_foto';
    // untuk fillable
    protected $fillable = [
        'id_rapat_det_foto',
        'id_rapat',
        'foto',
    ];

    // untuk relasi ke tabel rapat
    public function toRapat()
    {
        return $this->belongsTo(Rapat::class, 'id_rapat', 'id_rapat');
    }
}
