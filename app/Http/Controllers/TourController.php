<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\Categoria;
use Illuminate\Http\Request;

class TourController extends Controller
{
    /**
     * Mostrar el listado de tours.
     */
    public function index()
    {
        $tours = Tour::with('categoria')->get();
        return view('tours.index', compact('tours'));
    }

    /**
     * Mostrar el formulario para crear un tour.
     */
    public function create()
    {
        $categorias = Categoria::all();
        return view('tours.create', compact('categorias'));
    }

    /**
     * Guardar un nuevo tour en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'required',
            'precio' => 'required|numeric',
            'capacidad' => 'required|integer',
            'fecha' => 'required|date',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        Tour::create($request->all());

        return redirect()->route('tours.index')->with('success', 'Tour creado exitosamente.');
    }

    /**
     * Mostrar el formulario para editar un tour específico.
     */
    public function edit($id)
    {
        $tour = Tour::findOrFail($id);
        $categorias = Categoria::all();
        
        return view('tours.edit', compact('tour', 'categorias'));
    }

    /**
     * Actualizar el tour en la base de datos.
     */
    public function update(Request $request, $id)
    {
        $tour = Tour::findOrFail($id);

        $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'required',
            'precio' => 'required|numeric',
            'capacidad' => 'required|integer',
            'fecha' => 'required|date',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        $tour->update($request->all());

        return redirect()->route('tours.index')->with('success', 'Tour actualizado correctamente.');
    }

    /**
     * Eliminar un tour de la base de datos.
     */
    public function destroy($id)
    {
        $tour = Tour::findOrFail($id);
        $tour->delete();

        return redirect()->route('tours.index')->with('success', 'Tour eliminado correctamente.');
    }
}