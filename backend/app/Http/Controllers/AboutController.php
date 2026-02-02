<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    // Muestra la página "About"
    public function index()
    {
        return view('about.index');
    }
}
