<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class KontrakRencanaResource extends JsonResource
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
            "id_kontrak_rencana" => $this->id_kontrak_rencana,
            "id_kontrak"         => $this->id_kontrak,
            "minggu_ke"          => $this->minggu_ke,
            "bobot"              => $this->bobot
        ];
    }
}
