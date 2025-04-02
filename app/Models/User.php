<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Les attributs qui peuvent être attribués en masse.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'postal_code',        // Ajoute le champ 'postal_code'
        'address',            // Ajoute le champ 'address'
        'phone_number',       // Ajoute le champ 'phone_number'
    ];

    /**
     * Les attributs à cacher pour le tableau.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Les attributs qui doivent être convertis en types natifs.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

// app/Models/User.php
public function cartItems()
{
    return $this->hasMany(OrderItem::class, 'user_id')
                ->whereNull('order_id'); // seulement les items non commandés
}

}
