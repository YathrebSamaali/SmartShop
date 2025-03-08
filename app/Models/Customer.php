<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'points'];

    // Relation avec Order (un client peut avoir plusieurs commandes)
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
