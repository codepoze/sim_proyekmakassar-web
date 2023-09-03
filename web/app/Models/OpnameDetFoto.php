<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpnameDetFoto extends Model
{
    use HasFactory;
    // untuk default tabel
    protected $table = 'opname_det_foto';
    // untuk default primary key
    protected $primaryKey = 'id_opname_det_foto';
    // untuk fillable
    protected $fillable = [
        'id_opname_det_foto',
        'id_opname',
        'foto'
    ];

    // untuk relasi ke tabel opname
    public function toOpname()
    {
        return $this->belongsTo(Opname::class, 'id_opname', 'id_opname');
    }
}
