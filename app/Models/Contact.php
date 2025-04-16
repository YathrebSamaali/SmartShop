<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    // Table associée au modèle
    protected $table = 'contacts';

    // Champs qui peuvent être remplis
    protected $fillable = ['name', 'email', 'subject', 'message'];

    // Gérer les timestamps si tu veux
    public $timestamps = true;
}
