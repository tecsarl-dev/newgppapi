<?php
namespace App\Gpp\Auth\repositories;

use App\Gpp\Roles\Role;
use App\Gpp\Users\User;
use App\Gpp\Companies\Company;
use Illuminate\Support\Facades\DB;
use App\Exceptions\CustomException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\UltimateException;
use Illuminate\Auth\Events\Registered;

class AuthRepository
{

    private User $user;
    private Company $company;

    public function __construct(User $user, Company $company)
    {
      $this->user = $user;
      $this->company = $company;
    }

    public function register()
    {
      try {
        DB::beginTransaction();
          # enregistrer l'entreprise
          $company = $this->company->create([
            "address" => request("company_address"),
            "email" => request("company_email"),
            "legal_form_id" => request("company_legal_form_id"),
            "name" => request("company_name"),
            "ifu" => request("company_number_if"),
            "rccm" => request("company_number_rc"),
            "phone" => request("company_phone"),
            "type_company" => request("company_type_company"),
          ]);

          $user = $company->users()->create([ 
            "email" => request('admin_email'),
            "firstname" => request('admin_firstname'),
            "lastname" => request('admin_lastname'),
            "password" => request('admin_password'),
            "phone" => request('admin_phone')
          ]);

        $role = $company->roles()->where("name","administrateur")->first();
        
        $user->roles()->sync([$role->id]);

        event(new Registered($user));
        
        DB::commit();
        return 0;
      } catch (\Throwable $th) {
        DB::rollBack();
        throw $th;
      }
    }

    public function login()
    {
      try {
        if (Auth::attempt([
            'email' => request('email'),
            'password' => request('password')
        ])) {
            $user = User::find(Auth::id());

            if (!$user->hasVerifiedEmail()) {
              Log::error('Has Not verified');
              throw new CustomException("Veuillez confirmer votre adresse e-mail pour continuer.");
            }

            $role = $user->roles()->first();
            $permissions = $role->permissions;

            $sanctum_abilities = [];

            foreach ($permissions as $item) {
              array_push($sanctum_abilities, $item->guard);
            }

            $token = $user->createToken("$user->id - personal token", $sanctum_abilities);
            
            return ['token' => $token->plainTextToken];
        }else{
          throw new CustomException("L'e-mail ou le mot de passe est incorrect.");
        }
      } 
      catch(CustomException $th)
      {   
        DB::rollBack();
        Log::error($th->error_message());
        throw new  UltimateException($th->error_message(), 400);
      }
      catch (\Throwable $th) {
        Log::error($th->getMessage());
        throw new UltimateException("Impossible de se connecter.",400);
      }
    }
    
}
