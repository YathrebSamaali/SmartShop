<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order; // ✅ Importation du modèle
use App\Models\User; // ✅ Importation du modèle

class OrdersSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();

        foreach ($users as $user) {
            Order::create([
                'user_id' => $user->id,
                'total' => rand(100, 2000),
            ]);
        }
    }
}
