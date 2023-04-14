<?php

namespace App\Listerners;
use App\Mail\SendVerification;
use App\Events\UserVerifyEvent;
use Illuminate\Support\Facades\Mail;
// use App\Events\UserVerifyEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail as FacadesMail;

class UserVerifyListener implements ShouldQueue

{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserVerifyEvent $event)
    {
        $email = $event->user->email;
      Mail::to($email)->send(new SendVerification($event->user));
    }
}
