<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleBody extends Model
{
    use HasFactory;
    // untuk default tabel
    protected $table = 'role_bodies';
    // untuk default primary key
    protected $primaryKey = 'id_role_body';
    // untuk fillable
    protected $fillable = [
        'id_role_body',
        'id_role',
        'id_menu_body',
        'by_users'
    ];

    // untuk relasi ke tabel role
    public function toRole()
    {
        return $this->belongsTo(Role::class, 'id_role', 'id_role');
    }

    // untuk relasi ke tabel menu_nody
    public function toMenuBody()
    {
        return $this->belongsTo(MenuBody::class, 'id_menu_body', 'id_menu_body');
    }
}
