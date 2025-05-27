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

class TicketReplayEvent   implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */

   public $replay;
    public function __construct(TicketReply $replay)
    {
      $this->replay=$replay;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('ticket-replay.'. $this->replay->ticket_id)
        ];
    }
    public function broadcastAs(): ?string
    {
        return 'new.replay';
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
