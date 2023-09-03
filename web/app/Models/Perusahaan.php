<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    use HasFactory;
    // untuk default tabel
    protected $table = 'perusahaan';
    // untuk default primary key
    protected $primaryKey = 'id_perusahaan';
    // untuk fillable
    protected $fillable = [
        'id_perusahaan',
        'nama',
        'telepon',
        'alamat',
        'by_users'
    ];
}
