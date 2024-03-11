<?php

namespace App\Http\Resources\API\Todo;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TodoCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => TodoResource::collection($this->collection),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
