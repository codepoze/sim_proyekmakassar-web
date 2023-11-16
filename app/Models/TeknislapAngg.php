<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeknislapAngg extends Model
{
    use HasFactory;
    // untuk default tabel
    protected $table = 'teknislap_angg';
    // untuk default primary key
    protected $primaryKey = 'id_teknislap_angg';
    // untuk fillable
    protected $fillable = [
        'id_teknislap_angg',
        'id_teknislap',
        'nik',
        'nama',
        'telepon',
        'alamat',
        'by_users'
    ];

    // untuk relasi ke tabel teknislap
    public function toTeknislap()
    {
        return $this->belongsTo(Teknislap::class, 'id_teknislap', 'id_teknislap');
    }
}
