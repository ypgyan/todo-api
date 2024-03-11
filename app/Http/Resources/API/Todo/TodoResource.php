<?php

namespace App\Http\Resources\API\Todo;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TodoResource extends JsonResource
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
            'description' => $this->description,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at->subHours(3)->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->subHours(3)->format('Y-m-d H:i:s'),
        ];
    }
}
