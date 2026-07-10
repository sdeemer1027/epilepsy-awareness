<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Display the public home page.
     */
    public function index()
    {
        return view('home.index');
    }
}
