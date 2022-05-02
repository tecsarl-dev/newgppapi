<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            "is_active" => $this->is_active,
            "measure_id" => $this->measure_id,
            "measure" => $this->measure,
            "packages" => $this->packages,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
