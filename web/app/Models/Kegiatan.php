<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;
    // untuk default tabel
    protected $table = 'kegiatans';
    // untuk default primary key
    protected $primaryKey = 'id_kegiatan';
    // untuk fillable
    protected $fillable = [
        'id_kegiatan',
        'nama',
        'tgl',
        'by_users'
    ];
}
