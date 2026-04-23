<?php

namespace Database\Factories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

class AuthorFactory extends Factory
{
    protected $model = Author::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->email(),
            'birth_date' => fake()->date(),
        ];
    }
}
