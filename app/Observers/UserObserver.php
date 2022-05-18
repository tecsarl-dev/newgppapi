<?php

namespace App\Observers;

use App\Gpp\Users\User;


class UserObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param  \App\Gpp\Users\User  $appGppUsersUser
     * @return void
     */
    public function created(User $appGppUsersUser)
    {
        //
    }

    /**
     * Handle the User "updated" event.
     *
     * @param  \App\Gpp\Users\User  $appGppUsersUser
     * @return void
     */
    public function updated(User $appGppUsersUser)
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\Gpp\Users\User  $appGppUsersUser
     * @return void
     */
    public function deleted(User $appGppUsersUser)
    {
        //
    }

    /**
     * Handle the User "restored" event.
     *
     * @param  \App\Gpp\Users\User  $appGppUsersUser
     * @return void
     */
    public function restored(User $appGppUsersUser)
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     *
     * @param  \App\Gpp\Users\User  $appGppUsersUser
     * @return void
     */
    public function forceDeleted(User $appGppUsersUser)
    {
        //
    }
}
