<?php

namespace App\Gpp\Stations\Requests;

use Illuminate\Validation\Rule;
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
        "code" => "required",
        "code_company" => "required:unique:stations",
        "name" => "required",
        "date_commissioning_station" => "required",
        "reference_authorization_construction" => "required",
        "commune_id" => "required",
        "locality_id" => "required",
      ];
    }

    public function messages()
    {
      return [];
    }


}
