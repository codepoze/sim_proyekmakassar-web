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
        'id_paket',
        'tgl',
        'foto',
        'video',
        'doc',
        'by_users'
    ];

    // untuk relasi ke tabel paket
    public function toPaket()
    {
        return $this->belongsTo(Paket::class, 'id_paket', 'id_paket');
    }
}
