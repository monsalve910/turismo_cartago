<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Tour;
use App\Models\TourHorario;
use App\Models\Ruta;
use App\Models\User;
use Illuminate\Http\Request;

class AdminTourController extends Controller
{
    public function index()
    {
        $tours = Tour::with(['categoria', 'ruta', 'guia'])->get();

        return view('admin.tours.index', compact('tours'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        $rutas = Ruta::all();
        $guias = User::where('role', 'guia')->with('categoria')->get();

        return view('admin.tours.create', compact('categorias', 'rutas', 'guias'));
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
            'guia_id' => 'nullable|exists:users,id',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'horarios' => 'nullable|array',
            'horarios.*' => 'nullable|date_format:H:i', // store siempre recibe H:i del formulario
        ]);

        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('tours', 'public');
            $validated['imagen'] = $path;
        }

        $tour = Tour::create($validated);

        if ($request->has('horarios')) {
            foreach ($request->horarios as $hora) {
                if (!empty($hora)) {
                    TourHorario::create([
                        'tour_id' => $tour->id,
                        'hora' => $hora,
                    ]);
                }
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
        $guias = User::where('role', 'guia')->with('categoria')->get();

        return view('admin.tours.edit', compact('tour', 'categorias', 'rutas', 'guias'));
    }

    public function update(Request $request, $id)
    {
        $tour = Tour::findOrFail($id);

        //  CAMBIO 1: Normalizar horarios quitando los segundos (H:i:s → H:i)
        if ($request->has('horarios')) {
            $horarios = array_map(function ($hora) {
                if (!empty($hora)) {
                    return substr($hora, 0, 5); // "08:30:00" → "08:30"
                }
                return $hora;
            }, $request->horarios);
            $request->merge(['horarios' => $horarios]);
        }

        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha' => 'required|date',
            'precio' => 'required|numeric|min:0',
            'capacidad' => 'required|integer|min:1',
            'categoria_id' => 'required|exists:categorias,id',
            'ruta_id' => 'required|exists:rutas,id',
            'guia_id' => 'nullable|exists:users,id',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'horarios' => 'nullable|array',
            'horarios.*' => 'nullable|date_format:H:i',
        ]);

        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('tours', 'public');
            $validated['imagen'] = $path;
        }

        $tour->update($validated);
        //  CAMBIO 2: Filtrar horarios vacíos al guardar
        $tour->horarios()->delete();
        if ($request->has('horarios')) {
            foreach ($request->horarios as $hora) {
                if (!empty($hora)) { // ← evita insertar horas vacías
                    TourHorario::create([
                        'tour_id' => $tour->id,
                        'hora' => $hora,
                    ]);
                }
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