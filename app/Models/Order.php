<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'total'];

    // Relation avec Customer (une commande appartient à un client)
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Relation avec OrderItem (une commande contient plusieurs articles)
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
