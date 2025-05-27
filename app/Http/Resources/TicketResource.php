<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            
            'ticketable_type' => $this->ticketable_type,
            'ticketable' => $this->getResource()::make($this->whenLoaded('ticketable')),
            'ticketReplies' => TictetReplayResource::collection($this->whenLoaded('ticketReplies')),
        ];

    }
    private function getResource()
    {
        return 'App\\Http\\Resources\\'.class_basename($this->ticketable) . 'Resource';
    }
}
