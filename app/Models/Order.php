<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'customer_first_name',
        'customer_last_name',
        'customer_email',
        'customer_phone',
        'total',
        'subtotal',
        'delivery_cost',
        'tax_amount',
        'payment_method',
        'delivery_method',
        'delivery_street',
        'delivery_city',
        'delivery_zip_code',
        'delivery_country',
        'notes',
        'status'
    ];

    protected $attributes = [
        'status' => 'pending',
        'tax_amount' => 0,
    ];

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    // Méthode pour générer un numéro de commande
    public static function generateOrderNumber(): string
    {
        return 'ORD-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));
    }
}
