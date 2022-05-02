<?php

namespace App\Gpp\Rates\Requests;

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
        'code'=>'required|unique:rates',
        'commune_start_id'=>'required',
        'product_id'=>'required',
        'unit_price'=>'required',
        'commune_end_id'=>'required',
        'locality_start_id'=>'required',
        'locality_end_id'=>'required',
      ];
    }

    public function messages()
    {
      return [
        // 'code.required' => "Le code du depot est requis",
        // 'code.unique' => "Le code du depot est déjà utilisé",
        // 'name.required' => 'Le nom du depot est requis',
        // 'capacity.required' => 'La capacité du depot est requise',
        // 'locality_id.required' => "La localité du depot est requise"
      ];
    }


}
