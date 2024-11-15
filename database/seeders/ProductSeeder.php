<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Create 200 products with varying prices
        for ($i = 1; $i <= 200; $i++) {
            Product::create([
                'name' => "Product {$i}",
                'price' => rand(1000, 100000) / 100, // Random price between 10.00 and 1000.00
                'stock' => rand(0, 1000),
            ]);
        }
    }
}
