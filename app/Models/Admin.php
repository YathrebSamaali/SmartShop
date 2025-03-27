<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    // Les attributs qui peuvent être affectés en masse
    protected $fillable = ['email', 'password'];

    // Les attributs à cacher (ne seront pas retournés dans les réponses JSON)
    protected $hidden = ['password', 'remember_token'];

    // Si tu veux que la date soit automatiquement gérée
    protected $dates = ['created_at', 'updated_at'];

    // Utilisation de la méthode bcrypt() pour hasher le mot de passe avant l'enregistrement
    public static function boot()
    {
        parent::boot();

        static::creating(function ($admin) {
            if ($admin->password) {
                $admin->password = bcrypt($admin->password);
            }
        });
    }
}
