<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@biblioteca.com',
            'password' => bcrypt('12345678'),
            'role' => 'admin',
        ]);
    }
}
