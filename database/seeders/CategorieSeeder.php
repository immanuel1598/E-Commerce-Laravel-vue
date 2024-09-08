<?php

namespace Database\Seeders;

use App\Models\Categorie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Categorie::create([
            'name' => 'computer',
            'slug' => 'PC'
        ]);
        Categorie::create([
            'name' => 'phone',
            'slug' => 'tel'
        ]);
        Categorie::create([
            'name' => 'Watc',
            'slug' => 'montre'
        ]);
    }
}
