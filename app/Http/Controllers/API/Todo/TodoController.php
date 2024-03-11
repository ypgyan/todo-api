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
    public function index(): Application|Response|\Illuminate\Contracts\Foundation\Application|ResponseFactory
    {
        return response(new TodoCollection(Todo::paginate(10)));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): Application|Response|\Illuminate\Contracts\Foundation\Application|ResponseFactory
    {
        $validatedData = $request->validate([
            'description' => 'required',
        ]);

        return response(new TodoResource($this->service->createTodo(
            $validatedData
        )));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
