<?php

namespace App\Gpp\Auth\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
      "admin_c_password" => "required_with:admin_password|same:admin_password|min:8",
      "admin_email" => "required|unique:users,email|email:rfc,dns",
      "admin_firstname" => "required",
      "admin_lastname" => "required",
      "admin_password" => "required|min:8",
      "admin_phone" => "required",
      "admin_role" => "required",
      "company_address" => "required",
      "company_email" => "required|email:rfc,dns",
      "company_legal_form_id" => "required",
      "company_name" => "required",
      "company_number_if" => "required|unique:companies,ifu",
      "company_number_rc" => "required|unique:companies,rccm",
      "company_phone" => "required",
      "company_type_company" => "required",
    ];
  }

  public function messages()
  {
    return [
      "admin_c_password.same" => "les mots de passe doivent correspondre",
      "admin_c_password.required" => "le mot de passe est requis",
      "admin_c_password.required_with" => "Le champ Confimez mot de passe est requis lorsque le mot de passe est présent.",
      "admin_email.required" => "l'adresse e-mail est requis",
      "admin_email.unique" => "l'adresse e-mail a dejà été utilisée",
      "admin_firstname.required" => "le prenom est requis.",
      "admin_lastname.required" => "le nom est requis",
      "admin_password.required" => "le mot de passe est requis",
      "admin_password.min" => "le mot de passe doit comporter au moins :min caractères.",
      "admin_c_password.min" => "le mot de passe doit comporter au moins :min caractères.",
      "admin_phone.required" => "le telephone est requis",
      "admin_role.required" => "le role est requis",
      "company_address.required" => "L'adresse de l'entreprise est requise",
      "company_email.required" => "L'adresse e-mail de l'entreprise est requise",
      "company_email.unique" => "L'adresse e-mail de l'entreprise a dejà été utilisée",
      "company_legal_form_id.required" => "La forme juridique est requise",
      "company_name.required" => "La raison sociale est requise",
      "company_number_if.required" => "Le numero IFU est requis",
      "company_number_if.unique" => "Le numero IFUa a dejà été utilisé",
      "company_number_rc.required" => "Le Registre de commerce est requis",
      "company_number_rc.unique" => "Le Registre de commerce a dejà été utilisé",
      "company_phone.required" => "Le telephone de l'entreprise est requis",
      "company_type_company.required" => "le type est requis ",
    ];
  }


}