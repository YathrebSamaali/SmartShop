<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    // Affiche la page de contact
    public function index()
    {
        return view('contact.index');  // Retourne la vue de contact
    }
}
