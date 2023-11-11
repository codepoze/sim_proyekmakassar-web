<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyedia extends Model
{
    use HasFactory;
    // untuk default tabel
    protected $table = 'penyedia';
    // untuk default primary key
    protected $primaryKey = 'id_penyedia';
    // untuk fillable
    protected $fillable = [
        'id_penyedia',
        'nama',
        'telepon',
        'alamat',
        'by_users'
    ];
}
