<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer; // ✅ Importation correcte du modèle

class CustomersSeeder extends Seeder
{
    public function run()
    {
        $customers = [
            ['name' => 'Alice Dupont', 'email' => 'alice@example.com'],
            ['name' => 'Mohamed Ali', 'email' => 'mohamed@example.com'],
            ['name' => 'Fatima Zahra', 'email' => 'fatima@example.com'],
        ];

        foreach ($customers as $customer) {
            Customer::create($customer); // ✅ Maintenant ça fonctionne
        }
    }
}

