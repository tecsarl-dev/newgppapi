<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LoadingSlipResource extends JsonResource
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
            "qr_code" => $this->qr_code,
            "loading_number" => $this->loading_number,
            "loading_number_code" => $this->loading_number_code,
            "loading_type" => $this->loading_type,
            "driver_name" => $this->driver_name,
            "driver_tel" => $this->driver_tel,
            "ref_avd" => $this->ref_avd,
            "ref_other" => $this->ref_other,
            "is_published" => $this->is_published,
            "depot_id" => $this->depot_id,
            "depot" => new DepotResource($this->depot),
            "list_products" => $this->listProducts,
            "transporter_id" => $this->transporter_id,
            "transporter" => $this->transporter,
            "truck_id" => $this->truck_id,
            "truck" => $this->truck,
            "truck_trailer_id" => $this->truck_trailer_id,
            "truck_trailer" => $this->truckTrailer,
        ];
    }
}
