<?php

use App\Models\User;
use Laravel\Sanctum\Sanctum;

test("Logout user", function () {
    $user = User::factory()->create([
        'email' => 'test@example.com',
        'password' => bcrypt('password'),
    ]);

    Sanctum::actingAs($user);
    $response = $this->post('/api/logout');
    $response->assertOk();
    $this->assertDatabaseCount('personal_access_tokens', 0);
});
