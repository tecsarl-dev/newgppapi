<?php

namespace App\Gpp\LoadingSlips\Requests;

use App\Gpp\Trucks\Truck;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
      $validation = [
        "loading_type" => "required",
        "list_products" => "required",
        "loading_number" => "required",
        "driver_name" => "required",
        "driver_tel" => "required",
        "depot_id" => "required",
        "transporter_id" => "required",
        "truck_id" => "required",
      ];
      
      $truck = Truck::findOrFail($this->truck_id);
      if ($truck->type == 'tractor') {
        $validation["truck_trailer_id"] = "required";
      }


      return $validation;
    }

    public function messages()
    {
      return [
        
      ];
    }


}
