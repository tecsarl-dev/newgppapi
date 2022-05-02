<?php

namespace App\Gpp\Measures\Requests;

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
      ];
    }

    public function messages()
    {
      return [
        'code.required' => "Le code du produit est requis",
        'name.required' => 'Le nom du produit est requis',
        'packages.required' => 'Le conditionnement du produit est requis',
      ];
    }


}