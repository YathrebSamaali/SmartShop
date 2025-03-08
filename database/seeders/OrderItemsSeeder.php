<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order; // ✅ Importation du modèle
use App\Models\Product; // ✅ Importation du modèle
use App\Models\OrderItem; // ✅ Importation du modèle

class OrderItemsSeeder extends Seeder
{
    public function run()
    {
        $orders = Order::all();
        $products = Product::all();

        foreach ($orders as $order) {
            $randomProducts = $products->random(rand(1, 3));

            foreach ($randomProducts as $product) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => rand(1, 5),
                    'price' => $product->price,
                ]);
            }
        }
    }
}

