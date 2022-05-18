<?php

namespace App\Observers;

use App\Gpp\Companies\Company;
use App\Gpp\Features\Feature;

class CompanyObserver
{
    /**
     * Handle the Company "created" event.
     *
     * @param  \App\Gpp\Companies\Company  $company
     * @return void
     */
    public function created(Company $company)
    {
        # creer les roles primaires de cette entreprise
        $roles = $company->roles()->create([
            "name" => "Administrateur",
            "description" => "Effectue generalement toutes les taches incluant la gestion des utilisateurs de l'application",
            "default_create" => 1
        ]);
        
        $features  = Feature::where("type_company","all")->orWhere("type_company",$company->type_company)->with("permissions")->orderBy("name", "asc")->get();
        $perms = [];
        foreach ($features as $feature) {
            foreach ($feature->permissions as $permission) {
                array_push($perms, $permission->id);
            }
        }

        $permissionRole = $roles->permissions()->sync($perms);
    }

    /**
     * Handle the Company "updated" event.
     *
     * @param  \App\Gpp\Companies\Company  $company
     * @return void
     */
    public function updated(Company $company)
    {
        //
    }

    /**
     * Handle the Company "deleted" event.
     *
     * @param  \App\Gpp\Companies\Company  $company
     * @return void
     */
    public function deleted(Company $company)
    {
        //
    }

    /**
     * Handle the Company "restored" event.
     *
     * @param  \App\Gpp\Companies\Company  $company
     * @return void
     */
    public function restored(Company $company)
    {
        //
    }

    /**
     * Handle the Company "force deleted" event.
     *
     * @param  \App\Gpp\Companies\Company  $company
     * @return void
     */
    public function forceDeleted(Company $company)
    {
        //
    }
}
