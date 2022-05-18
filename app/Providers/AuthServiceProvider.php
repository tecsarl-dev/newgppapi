<?php

namespace App\Providers;

use App\Gpp\Users\User;
use Illuminate\Support\Facades\Gate;

use Illuminate\Support\Facades\Lang;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        "App\Gpp\Trucks\Truck" => "App\Policies\TruckPolicy",
        "App\Gpp\Products\Product" => "App\Policies\ProductPolicy",
        "App\Gpp\Deliveries\Delivery" => "App\Policies\DeliveryPolicy",
        "App\Gpp\LoadSlips\LoadSlip" => "App\Policies\LoadSlipPolicy",
        "App\Gpp\Stations\Station" => "App\Policies\StationPolicy",
        "App\Gpp\Rates\Rate" => "App\Policies\RatePolicy",
        "App\Gpp\Depots\Depot" => "App\Policies\DepotPolicy",
        "App\Gpp\Companies\Company" => "App\Policies\CompanyPolicy",
        "App\Gpp\Roles\Role" => "App\Policies\RolePolicy",
        "App\Gpp\Users\User" => "App\Policies\UserPolicy",
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        VerifyEmail::toMailUsing(function (User $user, string $verificationUrl) {
            return (new MailMessage)
                ->markdown("emails.verification.email") 
                ->subject(Lang::get('message.verify_mail.verify_email_address'))
                ->line(Lang::get('message.verify_mail.please_click_the_button_below_to_verify_your_email_address'))
                ->action(Lang::get('message.verify_mail.verify_email_address'), $verificationUrl)
                ->line(Lang::get('message.verify_mail.if_you_did_not_create_an_account_no_further_action_is_required'));
        });

    }
}
