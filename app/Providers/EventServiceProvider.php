<?php

namespace App\Providers;

use App\Gpp\Users\User;
use App\Events\AccountCreated;
use App\Gpp\Companies\Company;
use App\Observers\UserObserver;
use App\Observers\CompanyObserver;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use App\Listeners\SendMailVerification;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        AccountCreated::class => [
            SendMailVerification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Company::observe(CompanyObserver::class);
        User::observe(UserObserver::class);
    }
}
