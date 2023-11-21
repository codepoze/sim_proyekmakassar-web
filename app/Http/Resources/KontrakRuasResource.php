<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class KontrakRuasResource extends JsonResource
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
            "id_kontrak_ruas" => $this->id_kontrak_ruas,
            "id_kontrak" => $this->id_kontrak,
            "nama" => $this->nama,
            "by_users" => $this->by_users,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
