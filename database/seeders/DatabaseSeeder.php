<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

       User::create([
        'name' => 'Immanuel',
        'email' => 'okwuimma@gmail.com',
        'password' =>'rayquaza',
        'isAdmin' => 1,
       ]);
       $this->call([ CategorieSeeder::class,BrandSeeder::class,ProductSeeder::class]);

       
    }
}
