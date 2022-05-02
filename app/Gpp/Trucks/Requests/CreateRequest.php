<?php

namespace App\Gpp\Trucks\Requests;

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
        "type" => ["required",Rule::in(['tractor','trailer','all-in-one'])],
        "capacity" =>[Rule::requiredIf(fn () => request('type') != 'tractor')],
        "registration_number" => "required|unique:trucks",
        "transporter_id" => "required",
      ];
    }

    public function messages()
    {
      return [];
    }


}
