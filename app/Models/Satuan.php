<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    use HasFactory;
    // untuk default tabel
    protected $table = 'satuan';
    // untuk default primary key
    protected $primaryKey = 'id_satuan';
    // untuk fillable
    protected $fillable = [
        'id_satuan',
        'nama',
        'by_users'
    ];
}
