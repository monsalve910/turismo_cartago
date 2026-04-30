<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Tour;
use App\Models\Ruta;
use Illuminate\Http\Request;

class AdminTourController extends Controller
{
    public function index()
    {
        $tours = Tour::with(['categoria', 'ruta'])->get();

        return view('admin.tours.index', compact('tours'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        $rutas = Ruta::all();

        return view('admin.tours.create', compact('categorias', 'rutas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha' => 'required|date',
            'precio' => 'required|numeric|min:0',
            'capacidad' => 'required|integer|min:1',
            'categoria_id' => 'required|exists:categorias,id',
            'ruta_id' => 'required|exists:rutas,id',
        ]);

        Tour::create($validated);

        return redirect()->route('admin.tours.index')
            ->with('success', 'Tour creado correctamente');
    }

    public function edit($id)
    {
        $tour = Tour::findOrFail($id);
        $categorias = Categoria::all();
        $rutas = Ruta::all();

        return view('admin.tours.edit', compact('tour', 'categorias', 'rutas'));
    }

    public function update(Request $request, $id)
    {
        $tour = Tour::findOrFail($id);

        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha' => 'required|date',
            'precio' => 'required|numeric|min:0',
            'capacidad' => 'required|integer|min:1',
            'categoria_id' => 'required|exists:categorias,id',
            'ruta_id' => 'required|exists:rutas,id',
        ]);

        $tour->update($validated);

        return redirect()->route('admin.tours.index')
            ->with('success', 'Tour actualizado correctamente');
    }

    public function destroy($id)
    {
        $tour = Tour::findOrFail($id);
        $tour->delete();

        return redirect()->route('admin.tours.index')
            ->with('success', 'Tour eliminado exitosamente');
    }
}
