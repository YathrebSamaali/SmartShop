<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'status',
        'subtotal',
        'delivery_cost',
        'tax_amount',
        'payment_method',
        'delivery_method',
        'delivery_street',
        'delivery_city',
        'delivery_zip_code',
        'delivery_country',
        'notes'
    ];

    protected $casts = [
        'total' => 'decimal:2',
        'subtotal' => 'decimal:2',
        'delivery_cost' => 'decimal:2',
        'tax_amount' => 'decimal:2'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}