<?php

use App\Models\Mongo\Todo;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

test("Index returns user todos", function () {
    Todo::truncate();
    $user = Sanctum::actingAs(User::factory()->create());
    Todo::factory()->count(3)->create(['user_id' => $user->id]);

    $response = $this->get(route('todos.index'));

    $response->assertStatus(200);
    $response->assertJsonCount(3, 'data');
});

test("Store creates a new todo", function () {
    Todo::truncate();
    Sanctum::actingAs(User::factory()->create());
    $response = $this->postJson(route('todos.store'), ['description' => 'Test Todo']);

    $response->assertStatus(201);
    $response->assertJsonPath('data.description', 'Test Todo');
});

test("Store Validates Description", function () {
    Sanctum::actingAs(User::factory()->create());
    $response = $this->postJson(route('todos.store'), ['description' => 'Test Todo']);

    $response->assertStatus(201);
    $response->assertJsonPath('data.description', 'Test Todo');
});

test("Destroy Returns Forbidden For Non Owner", function () {
    Todo::truncate();
    Sanctum::actingAs(User::factory()->create());
    $todo = Todo::factory()->create();

    $response = $this->deleteJson(route('todos.destroy', $todo));
    $response->assertStatus(403);
});

test("test Destroy Deletes Todo", function () {
    Todo::truncate();
    $user = Sanctum::actingAs(User::factory()->create());
    $todo = Todo::factory()->create(['user_id' => $user->id]);

    $response = $this->deleteJson(route('todos.destroy', $todo));
    $response->assertStatus(204);
});
