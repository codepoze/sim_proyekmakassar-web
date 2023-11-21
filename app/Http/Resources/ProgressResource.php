<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProgressResource extends JsonResource
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
            "id_progress"=> $this->id_progress,
            "id_kontrak_ruas_item"=> $this->id_kontrak_ruas_item,
            "nma_pekerjaan"=> $this->nma_pekerjaan,
            "panjang"=> $this->panjang,
            "titik_core"=> $this->titik_core,
            "l_1"=> $this->l_1,
            "l_2"=> $this->l_2,
            "l_3"=> $this->l_3,
            "l_4"=> $this->l_4,
            "tki_1"=> $this->tki_1,
            "tki_2"=> $this->tki_2,
            "tki_3"=> $this->tki_3,
            "tte_1"=> $this->tte_1,
            "tte_2"=> $this->tte_2,
            "tte_3"=> $this->tte_3,
            "tka_1"=> $this->tka_1,
            "tka_2"=> $this->tka_2,
            "tka_3"=> $this->tka_3,
            "berat_bersih"=> $this->berat_bersih,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
