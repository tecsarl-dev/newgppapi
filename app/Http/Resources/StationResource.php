<?php

namespace App\Http\Resources;

use App\Http\Resources\CommuneResource;
use Illuminate\Http\Resources\Json\JsonResource;

class StationResource extends JsonResource
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
            "code_company" => $this->code_company,
            "name" => $this->name,
            "date_commissioning_station" => $this->date_commissioning_station,
            "reference_authorization_construction" => $this->reference_authorization_construction,
            "commune_id" => $this->commune_id,
            "locality_id" => $this->locality_id,
            "is_active" => $this->is_active,
            "commune" => new CommuneResource($this->commune),
            "locality" => new LocalityResource($this->locality),
            // "created_at" => $this->created_at,
                // "updated_at" => $this->updated_at,
        ];
    }
}
