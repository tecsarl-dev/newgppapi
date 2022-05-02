<?php

namespace App\Gpp\Companies\Requests;

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
        'type_company' => 'required',
        'name' => 'required',
        'ifu' => 'required',
        'rccm' => 'required',
        'legal_form_id' => 'required',
        'email' => 'required',
        'phone' => 'required',
      ];
    }

    public function messages()
    {
      return [
        'name.required' => 'La raison sociale est requise',
      ];
    }


}
