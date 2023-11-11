<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konsultan extends Model
{
    use HasFactory;
    // untuk default tabel
    protected $table = 'konsultan';
    // untuk default primary key
    protected $primaryKey = 'id_konsultan';
    // untuk fillable
    protected $fillable = [
        'id_konsultan',
        'nama',
        'telepon',
        'alamat',
        'by_users'
    ];
}
