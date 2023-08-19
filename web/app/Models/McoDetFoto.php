<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class McoDetFoto extends Model
{
    use HasFactory;
    // untuk default tabel
    protected $table = 'mco_det_foto';
    // untuk default primary key
    protected $primaryKey = 'id_mco_det_foto';
    // untuk fillable
    protected $fillable = [
        'id_mco_det_foto',
        'id_mco',
        'foto',
    ];

    // untuk relasi ke tabel mco
    public function toMco()
    {
        return $this->belongsTo(Mco::class, 'id_mco', 'id_mco');
    }
}
