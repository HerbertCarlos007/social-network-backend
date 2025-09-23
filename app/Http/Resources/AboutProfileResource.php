<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AboutProfileResource extends JsonResource
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
            'about' => $this->about,
            'works_at' => $this->works_at,
            'studied_at' => $this->studied_at,
            'lives_in' => $this->lives_in,
            'user_id' => $this->user_id,
        ];
    }
}
