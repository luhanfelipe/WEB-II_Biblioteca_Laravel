<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Autor;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;

class AuthorPublisherBookSeeder extends Seeder
{
    public function run(): void {
        Author::factory(100)->create()->each(function ($author) {

            $publisher = Publisher::factory()->create;

            $author->books()->createMany(
                Book::factory(10)->make([
                    'category_id' => Category::inRandomOrder()->first()->id,
                    'publisher_id' => $publisher->id,
                ])->toArray()
            );

        });
    }
}