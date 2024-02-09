<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RuasItem extends Model
{
    use HasFactory;
    // untuk default tabel
    protected $table = 'ruas_item';
    // untuk default primary key
    protected $primaryKey = 'id_ruas_item';
    // untuk fillable
    protected $fillable = [
        'id_ruas_item',
        'nama',
        'tipe',
        'by_users'
    ];
}
