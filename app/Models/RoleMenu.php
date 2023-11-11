<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleMenu extends Model
{
    use HasFactory;
    // untuk default tabel
    protected $table = 'role_menus';
    // untuk default primary key
    protected $primaryKey = 'id_role_menu';
    // untuk fillable
    protected $fillable = [
        'id_role_menu',
        'id_role',
        'id_menu_head',
        'by_users'
    ];

    // untuk relasi ke tabel role
    public function toRole()
    {
        return $this->belongsTo(Role::class, 'id_role', 'id_role');
    }

    // untuk relasi ke tabel menu_head
    public function toMenuHead()
    {
        return $this->belongsTo(MenuHead::class, 'id_menu_head', 'id_menu_head');
    }
}
