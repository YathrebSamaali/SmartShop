<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order; // ✅ Importation du modèle
use App\Models\Customer; // ✅ Importation du modèle

class OrdersSeeder extends Seeder
{
    public function run()
    {
        $customers = Customer::all();

        foreach ($customers as $customer) {
            Order::create([
                'customer_id' => $customer->id,
                'total' => rand(100, 2000),
            ]);
        }
    }
}
