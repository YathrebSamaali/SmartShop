<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'product_id', 'quantity', 'price'];

    // Relation avec Order (un article appartient à une commande)
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Relation avec Product (un article appartient à un produit)
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
