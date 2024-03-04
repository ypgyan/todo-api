<?php

use App\Models\User;
use Laravel\Sanctum\Sanctum;

test('users can authenticate using api route', function () {
    $user = User::factory()->create([
        'email' => 'test@example.com',
        'password' => bcrypt('password'),
    ]);

    $response = $this->post('/api/login', [
        'email' => $user->email,
        'password' => 'password',
        'device_name' => 'Bilal iPhone 12',
    ]);

    $response->assertOk();

    $this->assertNotEmpty(
        $response->getContent()
    );

    $this->assertDatabaseHas('personal_access_tokens',
        [
            'name' => 'Bilal iPhone 12',
            'tokenable_type' => User::class,
            'tokenable_id' => $user->id
        ]);
});

test("Access authenticated user's profile", function () {
    Sanctum::actingAs(User::factory()->create());
    $response = $this->get('/api/user');
    $response->assertOk();
});
