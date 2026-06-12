<?php

namespace App\Http\Controllers;

use App\Models\Tour;

class HomeController extends Controller
{
    public function index()
    {
        $tours = Tour::with('categoria')->orderBy('fecha', 'desc')->get();

        return view('welcome', compact('tours'));
    }
}
