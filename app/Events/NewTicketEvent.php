<?php

namespace App\Events;

use App\Models\Ticket;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewTicketEvent  implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $ticket;
    public function __construct(Ticket $ticket)
    {
        $this->ticket=$ticket;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('tickets-list'), 
        ];

    }
    public function broadcastAs(): ?string
    {
        return 'new.ticket';
    }
    public function broadcastWith(): array
    {
        return [
            'id' => $this->ticket->id,
            'title' => $this->ticket->title,
            'created_at' => $this->ticket->created_at->format('Y-m-d H:i'),
            'view_url' => route('tickets.show', $this->ticket->id),
        ];
    }
}
