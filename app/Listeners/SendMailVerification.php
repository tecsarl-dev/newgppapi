<?php

namespace App\Listeners;

use App\Events\AccountCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendMailVerification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\AccountCreated  $event
     * @return void
     */
    public function handle(AccountCreated $event)
    {
        $user =  $event->user;
        Mail::send('emails.verificationMail', [], function($message) use ($user) {
            $message->to($user['email']);
            $message->subject('Event Testing');
        });
    }
}
