<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class KontrakResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            "id_kontrak"        => $this->id_kontrak,
            "paket"             => $this->toPaket,
            "penyedia"          => $this->toPenyedia,
            "konsultan"         => $this->toKonsultan,
            "id_teknislap"      => $this->id_teknislap,
            "id_fund"           => $this->id_fund,
            "pj_penyedia"       => $this->pj_penyedia,
            "pj_konsultan"      => $this->pj_konsultan,
            "no_spmk"           => $this->no_spmk,
            "no_kontrak"        => $this->no_kontrak,
            "jns_kontrak"       => $this->jns_kontrak,
            "tgl_kontrak_mulai" => $this->tgl_kontrak_mulai,
            "tgl_kontrak_akhir" => $this->tgl_kontrak_akhir,
            "thn_anggaran"      => $this->thn_anggaran,
            "nil_pagu"          => $this->nil_pagu,
            "kd_rekening"       => $this->kd_rekening,
            "foto_lokasi"       => $this->foto_lokasi,
            "by_users"          => $this->by_users,
            "created_at"        => $this->created_at,
            "updated_at"        => $this->updated_at,
        ];
    }
}
