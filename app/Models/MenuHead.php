<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuHead extends Model
{
    use HasFactory;
    // untuk default tabel
    protected $table = 'menu_heads';
    // untuk default primary key
    protected $primaryKey = 'id_menu_head';
    // untuk fillable
    protected $fillable = [
        'id_menu_head',
        'nama',
        'icon',
        'path',
        'status',
        'jenis',
        'by_users'
    ];
}
