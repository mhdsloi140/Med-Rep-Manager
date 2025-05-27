<?php

use App\Models\Admin;
use App\Models\Delegate;
use App\Models\Ticket;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});


Broadcast::channel('ticket-replay.{ticketId}', function ($user, $ticketId) {
    $ticket = Ticket::find($ticketId);
   return $user->userable instanceof Admin || $ticket->delegate_id === $user->userable_id;
    // return true;

});
Broadcast::channel('notification.{id}', function ($user, $id) {

    return $user->userable_type === Delegate::class && $user->userable_id == $id;
});
