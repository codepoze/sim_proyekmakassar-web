<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pptk extends Model
{
    use HasFactory;
    // untuk default tabel
    protected $table = 'pptk';
    // untuk default primary key
    protected $primaryKey = 'id_pptk';
    // untuk fillable
    protected $fillable = [
        'id_pptk',
        'id_users',
        'nip',
        'by_users'
    ];

    // untuk foreign key
    protected $with = [
        'toUser'
    ];

    // untuk relasi ke tabel users
    public function toUser()
    {
        return $this->belongsTo(User::class, 'id_users', 'id_users');
    }
}
