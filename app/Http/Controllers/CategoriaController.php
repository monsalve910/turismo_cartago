<?php

namespace App\Http\Controllers;

use App\Models\Categoria;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();

        return view('categorias.index', compact('categorias'));
    }

    public function show($id)
    {
        $categoria = Categoria::with(['tours' => function ($q) {
            $q->orderBy('fecha', 'desc');
        }])->findOrFail($id);

        return view('categorias.show', compact('categoria'));
    }
}
