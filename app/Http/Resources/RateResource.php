<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RateResource extends JsonResource
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
            "id" => $this->id,
            "code" => $this->code,
            "product_id" => $this->product_id,
            "product" => $this->product,
            "unit_price" => $this->unit_price,
            "is_active" => $this->is_active,
            "commune_start_id" => $this->commune_start_id,
            "commune_end_id" => $this->commune_end_id,
            "locality_start_id" => $this->locality_start_id,
            "locality_end_id" => $this->locality_end_id,
            "commune_start" => $this->communeStart,
            "commune_end" => $this->communeEnd,
            "locality_start" => $this->localityStart,
            "locality_end" => $this->localityEnd,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
