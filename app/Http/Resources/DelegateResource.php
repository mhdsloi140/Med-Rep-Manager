<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DelegateResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'token' => $this->token
            // 'status' => $this->status->name,
            // 'ticketReplies' => TicketReplyResource::collection($this->whenLoaded('ticketReplies')),
        ];

    }
    private function getResource()
    {
        return 'App\\Http\\Resources\\'.class_basename($this->ticketable) . 'Resource';
    }
}
