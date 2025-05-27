<?php

namespace App\Events;

use App\Models\TicketReply;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TicketReplyCreated  implements  ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    // public $replay;
    public function __construct(public TicketReply $replay)
    {

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('ticket.' . $this->replay->ticket_id)
        ];
    }
    public function broadcastWith()
    {
        return [
            'id' => $this->replay->id,
            'message' => $this->replay->reply,
            'user' => $this->replay->user->name,
            'created_at' => $this->replay->created_at->diffForHumans(),
        ];
    }
}
