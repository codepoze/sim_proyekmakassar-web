<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;
    // untuk default tabel
    protected $table = 'paket';
    // untuk default primary key
    protected $primaryKey = 'id_paket';
    // untuk fillable
    protected $fillable = [
        'id_paket',
        'id_kegiatan',
        'nama',
        'by_users'
    ];

    // untuk foreign key
    protected $with = [
        'toKegiatan'
    ];

    // untuk relasi ke tabel kegiatan
    public function toKegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'id_kegiatan', 'id_kegiatan');
    }
}
