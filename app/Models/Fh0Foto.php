<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fh0Foto extends Model
{
    use HasFactory;
    // untuk default tabel
    protected $table = 'fh0_foto';
    // untuk default primary key
    protected $primaryKey = 'id_fh0_foto';
    // untuk fillable
    protected $fillable = [
        "id_fh0_foto",
        "id_fh0",
        "foto",
    ];
}
