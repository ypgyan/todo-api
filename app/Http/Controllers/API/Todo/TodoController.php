<?php

namespace App\Http\Controllers\API\Todo;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\Todo\TodoCollection;
use App\Http\Resources\API\Todo\TodoResource;
use App\Http\Services\TodoService;
use App\Models\Mongo\Todo;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class TodoController extends Controller
{
    public function __construct(public TodoService $service)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): TodoCollection
    {
        return new TodoCollection($this->service->getUserTodos($request->user()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): TodoResource
    {
        $validatedData = $request->validate([
            'description' => 'required',
        ]);

        $validatedData['user_id'] = $request->user()->id;
        return new TodoResource($this->service->createTodo(
            $validatedData
        ));
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo): TodoResource
    {
        if ($todo->user_id !== auth()->id()) {
            abort(403);
        }
        return new TodoResource($todo);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo): TodoResource
    {
        if ($todo->user_id !== auth()->id()) {
            abort(403);
        }

        $validatedData = $request->validate([
            'description' => 'required',
        ]);

        return new TodoResource($this->service->updateTodo(
            $todo,
            $validatedData
        ));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo): Application|Response|\Illuminate\Contracts\Foundation\Application|ResponseFactory
    {
        if ($todo->user_id !== auth()->id()) {
            return response(null, 403);
        }
        $this->service->deleteTodo($todo);
        return response(null, 204);
    }
}
