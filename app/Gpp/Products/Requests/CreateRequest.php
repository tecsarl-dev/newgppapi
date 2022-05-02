<?php

namespace App\Gpp\Products\Requests;

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
        'code'=>'required',
        'name'=>'required',
        'packages'=>'required',
        'measure_id'=>'required',
      ];
    }

    public function messages()
    {
      return [
        'code.required' => "Le code du produit est requis",
        'name.required' => 'Le nom du produit est requis',
        'packages.required' => 'Le conditionnement du produit est requis',
        'measure_id.required' => "L'unité de mesure du produit est requis"
      ];
    }


}