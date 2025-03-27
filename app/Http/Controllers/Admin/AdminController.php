<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Retourner la vue du tableau de bord
        return view('admin.dashboard');
    }
}
