<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    use HasFactory;
    // untuk default tabel
    protected $table = 'holiday';
    // untuk default primary key
    protected $primaryKey = 'id_holiday';
    // untuk fillable
    protected $fillable = [
        'id_holiday',
        'day',
        'month',
        'note',
        'by_users'
    ];
}
