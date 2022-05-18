<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserMeResource extends JsonResource
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
            "user_id" => $this->id,
            "firstname" => $this->firstname,
            "lastname" => $this->lastname,
            "email" => $this->email,
            "role" => $this->role,
            "company" => [
                "id" => $this->company->id,
                "type_company" => $this->company->type_company,
                "name" => $this->company->name,
                "ifu" => $this->company->ifu,
                "rccm" => $this->company->rccm,
            ],
        ];
    }
}
