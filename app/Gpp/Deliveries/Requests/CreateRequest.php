<?php

namespace App\Gpp\Deliveries\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "delivery_number" => "required",
            "delivery_type" => "required",
            "delivery_receiver" => "required",
            "commune_start_id" => "required",
            "commune_end_id" => "required",
            "locality_start_id" => "required",
            "locality_end_id" => "required",
            "loading_slip_id" => "required",
            "is_published"
        ];
    }
}
