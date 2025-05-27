<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TictetReplayResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'tiket_id'=>$this->ticket_id,
            'user_id'=>$this->user_id,
            'replay'=>$this->reply,
            'ticket' => TicketResource::make($this->whenLoaded('ticket')),

        ];
    }
}
