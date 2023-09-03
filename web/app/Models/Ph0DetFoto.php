<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ph0DetFoto extends Model
{
    use HasFactory;
    // untuk default tabel
    protected $table = 'ph0_det_foto';
    // untuk default primary key
    protected $primaryKey = 'id_ph0_det_foto';
    // untuk fillable
    protected $fillable = [
        'id_ph0_det_foto',
        'id_ph0',
        'foto'
    ];

    // untuk relasi ke tabel ph0
    public function toPh0()
    {
        return $this->belongsTo(Ph0::class, 'id_ph0', 'id_ph0');
    }
}
