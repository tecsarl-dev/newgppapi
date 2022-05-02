<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DepotResource extends JsonResource
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
            "name" => $this->name,
            "comments" => $this->comments,
            "capacity" => $this->capacity,
            "is_active" => $this->is_active,
            "locality_id" => $this->locality_id,
            "commune_id" => $this->commune_id,
            "locality" => new LocalityResource($this->locality),
            "commune" => new CommuneResource($this->commune),
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
