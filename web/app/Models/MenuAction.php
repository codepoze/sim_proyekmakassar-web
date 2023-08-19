<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuAction extends Model
{
    use HasFactory;
    // untuk default tabel
    protected $table = 'menu_actions';
    // untuk default primary key
    protected $primaryKey = 'id_menu_action';
    // untuk fillable
    protected $fillable = [
        'id_menu_action',
        'id_menu_head',
        'nama',
        'by_users'
    ];

    // untuk relasi ke tabel menu_head
    public function toMenuHead()
    {
        return $this->belongsTo(MenuHead::class, 'id_menu_head', 'id_menu_head');
    }
}
