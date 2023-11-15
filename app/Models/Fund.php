<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fund extends Model
{
    use HasFactory;
    // untuk default tabel
    protected $table = 'fund';
    // untuk default primary key
    protected $primaryKey = 'id_fund';
    // untuk fillable
    protected $fillable = [
        'id_fund',
        'nama',
        'by_users'
    ];
}
