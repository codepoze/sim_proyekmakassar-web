<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opname extends Model
{
    use HasFactory;
    // untuk default tabel
    protected $table = 'opname';
    // untuk default primary key
    protected $primaryKey = 'id_opname';
    // untuk fillable
    protected $fillable = [
        'id_opname',
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

    // untuk relasi ke tabel opname_det_foto
    public function toOpnameDetFoto()
    {
        return $this->hasMany(OpnameDetFoto::class, 'id_opname', 'id_opname');
    }
}
