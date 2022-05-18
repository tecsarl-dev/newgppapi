<?php

namespace App\Gpp\Auth\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
      "email" => "required|email:rfc,dns",
      "password" => "required|min:8",
    ];
  }

  public function messages()
  {
    return [
      "password.required" => "le mot de passe est requis",
      "email.required" => "l'adresse e-mail est requis",
      "password.min" => "le mot de passe doit comporter au moins :min caractères.",
      "email.email" => "L'adresse e-mail doit être une adresse e-mail valide."
    ];
  }


}