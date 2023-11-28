<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KontrakRencana extends Model
{
    use HasFactory;
    // untuk default tabel
    protected $table = 'kontrak_rencana';
    // untuk default primary key
    protected $primaryKey = 'id_kontrak_rencana';
    // untuk fillable
    protected $fillable = [
        'id_kontrak_rencana',
        'id_kontrak',
        'minggu_ke',
        'bobot',
    ];

    public function toKontrak()
    {
        return $this->belongsTo(Kontrak::class, 'id_kontrak', 'id_kontrak');
    }
}
