<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
class VistiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'visit_date' => $this->visit_date,
            'doctor' => DoctorResource::make($this->whenLoaded('doctor')),
            'sample' => SampleResource::collection($this->whenLoaded('sample')),
            'note'=>$this->note,
            'status' => $this->status,
        ];
    }
}
