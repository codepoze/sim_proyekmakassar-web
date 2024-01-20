<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class KontrakRuasItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id_kontrak_ruas_item" => $this->id_kontrak_ruas_item,
            "id_kontrak_ruas"      => $this->id_kontrak_ruas,
            "id_satuan"            => $this->id_satuan,
            "tipe"                 => $this->tipe,
            "nama"                 => $this->nama,
            "harga_hps"            => $this->harga_hps,
            "harga_kontrak"        => $this->harga_kontrak,
            "by_users"             => $this->by_users,
            "created_at"           => $this->created_at,
            "updated_at"           => $this->updated_at,
        ];
    }
}
