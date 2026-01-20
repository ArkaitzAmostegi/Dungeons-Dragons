<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        return view('about.index'); // nombre de tu Blade: resources/views/about.blade.php
    }
}
