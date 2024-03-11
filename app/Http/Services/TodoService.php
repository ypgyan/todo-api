<?php

namespace App\Http\Services;

use App\Models\Mongo\Todo;
use App\Models\User;

class TodoService
{
    public function createTodo(array $payload): Todo
    {
        return Todo::create([
            'description' => $payload['description'],
            'user_id' => $payload['user_id'],
        ]);
    }

    public function deleteTodo(Todo $todo): void
    {
        $todo->delete();
    }

    public function getUserTodos(User $user)
    {
        return Todo::where('user_id', $user->id)->paginate(10);
    }
}
