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
            'name' => $this->fake()->name(),
            'email' => $this->fake()->email(),
            'birth_date' => $this->fake()->date()
        ];
    }
}
