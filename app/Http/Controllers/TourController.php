<?php

namespace App\Http\Controllers;

use App\Models\Tour;

class TourController extends Controller
{
    public function index()
    {
        $tours = Tour::with('categoria')->get();

        return view('tours.index', compact('tours'));
    }

    public function show($id)
    {
        $tour = Tour::with(['categoria', 'comentarios.user'])->findOrFail($id);

        return view('tours.show', compact('tour'));
    }
}
