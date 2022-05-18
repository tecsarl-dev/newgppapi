<?php

namespace App\Policies;

use App\Gpp\Users\User;
use Illuminate\Auth\Access\Response;
use App\Gpp\LoadingSlips\LoadingSlip;
use Illuminate\Auth\Access\HandlesAuthorization;

class LoadingSlipPolicy
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
        return $user->tokenCan("loadingslip-view")? Response::allow()
        : Response::deny("Cette action n'est pas autorisée.");
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Gpp\Users\User  $user
     * @param  \App\Models\LoadingSlip  $loadingSlip
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user)
    {
        return $user->tokenCan("loadingslip-view")? Response::allow()
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
        return $user->tokenCan("loadingslip-creates")? Response::allow()
        : Response::deny("Cette action n'est pas autorisée.");
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Gpp\Users\User  $user
     * @param  \App\Models\LoadingSlip  $loadingSlip
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user)
    {
        return $user->tokenCan("loadingslip-update")? Response::allow()
        : Response::deny("Cette action n'est pas autorisée.");
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Gpp\Users\User  $user
     * @param  \App\Models\LoadingSlip  $loadingSlip
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user)
    {
        return $user->tokenCan("loadingslip-delete")? Response::allow()
        : Response::deny("Cette action n'est pas autorisée.");
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Gpp\Users\User  $user
     * @param  \App\Models\LoadingSlip  $loadingSlip
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
     * @param  \App\Models\LoadingSlip  $loadingSlip
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user)
    {
        //
    }
}
