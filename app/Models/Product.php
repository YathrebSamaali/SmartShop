<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'stock', 'image', 'category']; // Ajoutez 'category' ici

    // Relation avec OrderItem (un produit peut être dans plusieurs commandes)
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
