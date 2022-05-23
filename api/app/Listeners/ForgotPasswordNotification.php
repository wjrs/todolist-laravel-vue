<?php

namespace App\Listeners;

use App\Events\ForgotPasswordEvent;
use App\Mail\ForgotPasswordMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ForgotPasswordNotification
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
     * @param  ForgotPasswordEvent  $event
     * @return void
     */
    public function handle(ForgotPasswordEvent $event)
    {
        \Mail::to($event->user->email)->send(new ForgotPasswordMail($event->user, $event->token));
    }
}
