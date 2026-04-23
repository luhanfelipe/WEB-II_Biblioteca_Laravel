<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    
    public function run(): void
    {
        $categories = [
            'Ficção',
            'Fantasia',
            'Ciência',
            'Biografia',
            'História',
            'Tecnologia',
            'Culinária',
            'Arte',
            'Viagens'
        ];

        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }
    }
}
