<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'total'];

    // Relation avec Customer (une commande appartient à un client)
    public function user()
{
    return $this->belongsTo(User::class);
}


    // Relation avec OrderItem (une commande contient plusieurs articles)
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
