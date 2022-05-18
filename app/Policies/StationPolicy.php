<?php

namespace App\Policies;

use App\Gpp\Users\User;
use App\Gpp\Stations\Station;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class StationPolicy
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
        return $user->tokenCan("station-view")? Response::allow()
        : Response::deny("Cette action n'est pas autorisée.");
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Gpp\Users\User  $user
     * @param  \App\Models\Station  $station
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user)
    {
        return $user->tokenCan("station-view")? Response::allow()
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
        return $user->tokenCan("station-create")? Response::allow()
        : Response::deny("Cette action n'est pas autorisée.");
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Gpp\Users\User  $user
     * @param  \App\Models\Station  $station
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user)
    {
        return $user->tokenCan("station-update")? Response::allow()
        : Response::deny("Cette action n'est pas autorisée.");
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Gpp\Users\User  $user
     * @param  \App\Models\Station  $station
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user)
    {
        return $user->tokenCan("station-delete")? Response::allow()
        : Response::deny("Cette action n'est pas autorisée.");
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Gpp\Users\User  $user
     * @param  \App\Models\Station  $station
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
     * @param  \App\Models\Station  $station
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user)
    {
        //
    }
}
