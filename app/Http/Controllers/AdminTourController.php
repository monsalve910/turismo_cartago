<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Tour;
use App\Models\TourHorario;
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
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'horarios' => 'nullable|array',
            'horarios.*' => 'nullable|date_format:H:i:s',
        ]);

        // subir imagen
        if ($request->hasFile('imagen')) {

            $path = $request->file('imagen')->store('tours', 'public');

            $validated['imagen'] = $path;
        }

        $tour = Tour::create($validated);

        if ($request->has('horarios')) {
            foreach ($request->horarios as $hora) {
                TourHorario::create([
                    'tour_id' => $tour->id,
                    'hora' => $hora,
                ]);
            }
        }

        return redirect()
            ->route('admin.tours.index')
            ->with('success', 'Tour creado correctamente');
    }

    public function edit($id)
    {
        $tour = Tour::with('horarios')->findOrFail($id);
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
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'horarios' => 'nullable|array',
            'horarios.*' => 'nullable|date_format:H:i:s',
        ]);

        if ($request->hasFile('imagen')) {

            $path = $request->file('imagen')->store('tours', 'public');

            $validated['imagen'] = $path;
        }

        $tour->update($validated);

        $tour->horarios()->delete();
        if ($request->has('horarios')) {
            foreach ($request->horarios as $hora) {
                TourHorario::create([
                    'tour_id' => $tour->id,
                    'hora' => $hora,
                ]);
            }
        }

        return redirect()
            ->route('admin.tours.index')
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
