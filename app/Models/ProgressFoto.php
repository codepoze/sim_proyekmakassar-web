<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgressFoto extends Model
{
    use HasFactory;
    // untuk default tabel
    protected $table = 'progress_foto';
    // untuk default primary key
    protected $primaryKey = 'id_progress_foto';
    // untuk fillable
    protected $fillable = [
        "id_progress_foto",
        "id_progress",
        "foto",
    ];
}
