<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product; // ✅ Importation correcte du modèle Product

class ProductsSeeder extends Seeder
{
    public function run()
    {
        $products = [
            ['name' => 'Laptop HP', 'description' => 'PC portable performant', 'price' => 1500, 'stock' => 10],
            ['name' => 'iPhone 14', 'description' => 'Smartphone Apple', 'price' => 1200, 'stock' => 5],
            ['name' => 'Écouteurs Bluetooth', 'description' => 'Écouteurs sans fil', 'price' => 50, 'stock' => 30],
        ];

        foreach ($products as $product) {
            Product::create($product); // ✅ Maintenant ça fonctionne
        }
    }
}

