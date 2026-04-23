<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'author_id' => Author::factory(),
            'category_id' => Category::factory(),
            'publisher_id' => Publisher::factory(),
            'published_year' => fake()->year(),
            'pages' => fake()->numberBetween(100, 800),
        ];
    }
}
