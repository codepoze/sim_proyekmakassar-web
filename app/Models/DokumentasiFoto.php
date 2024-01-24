<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumentasiFoto extends Model
{
    use HasFactory;
    // untuk default tabel
    protected $table = 'dokumentasi_foto';
    // untuk default primary key
    protected $primaryKey = 'id_dokumentasi_foto';
    // untuk fillable
    protected $fillable = [
        "id_dokumentasi_foto",
        "id_dokumentasi",
        "foto",
    ];
}
