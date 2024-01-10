<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdendumRuas extends Model
{
    use HasFactory;
    // untuk default tabel
    protected $table = 'adendum_ruas';
    // untuk default primary key
    protected $primaryKey = 'id_adendum_ruas';
    // untuk fillable
    protected $fillable = [
        'id_adendum_ruas',
        'id_adendum',
        'id_kontrak_ruas',
        'by_users',
    ];

    // untuk foreign key
    protected $with = [
        'toAdendum',
        'toKontrakRuas'
    ];

    // untuk relasi ke tabel adendum
    public function toAdendum()
    {
        return $this->belongsTo(Adendum::class, 'id_adendum', 'id_adendum');
    }

    // untuk relasi ke tabel kontrak_ruas
    public function toKontrakRuas()
    {
        return $this->belongsTo(KontrakRuas::class, 'id_kontrak_ruas', 'id_kontrak_ruas');
    }
}
