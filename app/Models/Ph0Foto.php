<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ph0Foto extends Model
{
    use HasFactory;
    // untuk default tabel
    protected $table = 'ph0_foto';
    // untuk default primary key
    protected $primaryKey = 'id_ph0_foto';
    // untuk fillable
    protected $fillable = [
        "id_ph0_foto",
        "id_ph0",
        "foto",
    ];
}
