<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'image',
        'category'
    ];

    // Ensure timestamps are used (default is true)
    public $timestamps = true;

    // If you need to customize the date format
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    // Relation with OrderItem (a product can be in many orders)
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
