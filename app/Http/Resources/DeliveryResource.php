<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DeliveryResource extends JsonResource
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
            "delivery_number" => $this->delivery_number,
            "delivery_number_code" => $this->delivery_number_code,
            "delivery_type" => $this->delivery_type,
            "customer_name" => $this->customer_name,
            "delivery_receiver" => $this->delivery_receiver,
            "commune_start_id" => $this->commune_start_id,
            "commune_start" => $this->communeStart,
            "commune_end_id" => $this->commune_end_id,
            "commune_end" => $this->communeEnd,
            "locality_start_id" => $this->locality_start_id,
            "locality_start" => $this->localityStart,
            "locality_end_id" => $this->locality_end_id,
            "locality_end" => $this->localityEnd,
            "loading_slip_id" => $this->loading_slip_id,
            "loading_slip" => new LoadingSlipResource($this->loadingSlip),
            "station_id" => $this->station_id,
            "station" => $this->station,
            "list_products" => $this->listProducts,
            "is_published" => $this->is_published,
        ];
    }
}
