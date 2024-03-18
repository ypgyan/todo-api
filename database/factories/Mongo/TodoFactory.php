<?php

namespace Database\Factories\Mongo;

use App\Models\Mongo\Todo;
use Illuminate\Database\Eloquent\Factories\Factory;

class TodoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'description' => $this->faker->sentence,
            'user_id' => null,
        ];
    }
}
