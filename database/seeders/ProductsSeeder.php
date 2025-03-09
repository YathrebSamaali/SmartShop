<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsSeeder extends Seeder
{
    public function run()
    {
        $products = [
            // Add Clothing product with image and category
            ['name' => 'T-shirt Men', 'description' => 'Cotton T-shirt for men', 'price' => 20, 'stock' => 50, 'category' => 'Clothing', 'image' => 'images/tshirt_men.jpg'],

            // Add another Clothing product
            ['name' => 'Jeans Men', 'description' => 'Denim jeans for men', 'price' => 40, 'stock' => 30, 'category' => 'Clothing', 'image' => 'images/jeans_men.jpg'],

            // Add another Clothing product
            ['name' => 'Jacket Men', 'description' => 'Winter jacket for men', 'price' => 100, 'stock' => 20, 'category' => 'Clothing', 'image' => 'images/jacket_men.jpg'],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
