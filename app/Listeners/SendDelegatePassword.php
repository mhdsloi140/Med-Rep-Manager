<?php

namespace App\Listeners;

use App\Events\DelegateCreatedEvent;
use App\Mail\SendPasswordMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Mail;

class SendDelegatePassword implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     */
    public function __construct(DelegateCreatedEvent $event )
    {
        Mail::to($event->user->email)
        ->send(new SendPasswordMail($event->user, $event->rawPassword));
    }

    /**
     * Handle the event.
     */
    public function handle(DelegateCreatedEvent $event): void
    {
        //
    }
}
