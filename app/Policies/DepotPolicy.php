<?php

namespace App\Policies;

use App\Gpp\Users\User;
use App\Gpp\Depots\Depot;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class DepotPolicy
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
        return $user->tokenCan("depot-view")? Response::allow()
        : Response::deny("Cette action n'est pas autorisée.");
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Gpp\Users\User  $user
     * @param  \App\Models\Depot  $depot
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user)
    {
        if (Auth::user()->company != 'gpp') {
            return true;
        }
        return $user->tokenCan("depot-view")? Response::allow()
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
        return $user->tokenCan("depot-create")? Response::allow()
        : Response::deny("Cette action n'est pas autorisée.");
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Gpp\Users\User  $user
     * @param  \App\Models\Depot  $depot
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user)
    {
        return $user->tokenCan("depot-update")? Response::allow()
        : Response::deny("Cette action n'est pas autorisée.");
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Gpp\Users\User  $user
     * @param  \App\Models\Depot  $depot
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user)
    {
        return $user->tokenCan("depot-delete")? Response::allow()
        : Response::deny("Cette action n'est pas autorisée.");
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Gpp\Users\User  $user
     * @param  \App\Models\Depot  $depot
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
     * @param  \App\Models\Depot  $depot
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user)
    {
        //
    }
}
