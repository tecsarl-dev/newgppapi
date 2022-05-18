<?php

namespace App\Policies;

use App\Gpp\Users\User;
use App\Gpp\Products\Product;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class ProductPolicy
{
    use HandlesAuthorization;
 
    
    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Gpp\Users\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        if (Auth::user()->company != 'gpp') {
            return true;
        }
        return $user->tokenCan("product-view")? Response::allow()
        : Response::deny("Cette action n'est pas autorisée.");
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Gpp\Users\User  $user
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user)
    {
        if (Auth::user()->company != 'gpp') {
            return true;
        }
        return $user->tokenCan("product-view")? Response::allow()
        : Response::deny("Cette action n'est pas autorisée.");
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Gpp\Users\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->tokenCan("product-create")? Response::allow()
        : Response::deny("Cette action n'est pas autorisée.");
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Gpp\Users\User  $user
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user)
    {
        return $user->tokenCan("product-update")? Response::allow()
        : Response::deny("Cette action n'est pas autorisée.");
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Gpp\Users\User  $user
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user)
    {
        return $user->tokenCan("product-delete")? Response::allow()
        : Response::deny("Cette action n'est pas autorisée.");
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Gpp\Users\User  $user
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Gpp\Users\User  $user
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user)
    {
        //
    }
}
