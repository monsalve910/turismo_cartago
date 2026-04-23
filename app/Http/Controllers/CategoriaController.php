<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = \App\Models\Categoria::all();

        return view('categorias.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categorias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'name' => 'required|unique:categorias|max:255',
    ]);

    \App\Models\Categoria::create($request->all());

    return redirect()->route('categorias.create')->with('success', 'Categoria creada');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(\App\Models\Categoria $categoria) 
    {
    return view('categorias.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, \App\Models\Categoria $categoria)
    {
    $request->validate([
        'name' => 'required|max:255|unique:categorias,name,' . $categoria->id,
    ]);

    $categoria->update($request->all());

    return redirect()->route('categorias.index')->with('success', 'Categoria actualizada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(\App\Models\Categoria $categoria)
{
    $categoria->delete();

    return redirect()->route('categorias.index')->with('success', 'Categoria eliminada');
}
}
