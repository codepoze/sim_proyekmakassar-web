<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleAction extends Model
{
    use HasFactory;
    // untuk default tabel
    protected $table = 'role_actions';
    // untuk default primary key
    protected $primaryKey = 'id_role_action';
    // untuk fillable
    protected $fillable = [
        'id_role_action',
        'id_role',
        'id_menu_action',
        'status',
        'by_users'
    ];

    // untuk relasi ke tabel role
    public function toRole()
    {
        return $this->belongsTo(Role::class, 'id_role', 'id_role');
    }

    // untuk relasi ke tabel menu_action
    public function toMenuAction()
    {
        return $this->belongsTo(MenuAction::class, 'id_menu_action', 'id_menu_action');
    }
}
