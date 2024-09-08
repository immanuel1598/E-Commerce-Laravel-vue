<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'title' => 'Central Optimization Executive',
            'price' => '19.93',
            'quantity' => 3,
            'categorie_id' => 1,
            'brand_id'=> 1,
            'description' => 'Autem sint quisquam consectetur nostrum asperiores aut reiciendis. Quis odit numquam omnis. Nam non ducimus et natus quibusdam unde eos. Praesentium et illum cumque architecto. Ratione debitis veniam quidem ullam ullam id.'
        ]);
    }
}
