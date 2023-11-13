<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    // untuk default tabel
    protected $table = 'roles';
    // untuk default primary key
    protected $primaryKey = 'id_role';
    // untuk fillable
    protected $fillable = [
        'id_role',
        'nama',
        'role',
        'by_users'
    ];
}