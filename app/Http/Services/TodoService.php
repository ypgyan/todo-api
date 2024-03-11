<?php

namespace App\Http\Services;

use App\Models\Mongo\Todo;

class TodoService
{
    public function createTodo(array $payload)
    {
        return Todo::create([
            'description' => $payload['description'],
            'user_id' => $payload['user_id'],
        ]);
    }
}
