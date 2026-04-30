<?php

namespace App\Http\Controllers;

use App\Models\Lugar;
use App\Models\Ruta;
use Illuminate\Http\Request;

class AdminRutaController extends Controller
{
    public function index()
    {
        $rutas = Ruta::with('lugares')->get();

        return view('admin.rutas.index', compact('rutas'));
    }

    public function create()
    {
        $lugares = Lugar::all();

        return view('admin.rutas.create', compact('lugares'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
        ]);

        $ruta = Ruta::create($validated);

        // Si quieres guardar lugares desde aquí (uno a muchos)
        if ($request->has('lugares')) {
            foreach ($request->lugares as $lugar) {
                $ruta->lugares()->create([
                    'nombre' => $lugar['nombre'],
                    'descripcion' => $lugar['descripcion'] ?? null,
                    'orden' => $lugar['orden'] ?? 0,
                    'imagen' => $lugar['imagen'] ?? null,
                ]);
            }
        }

        return redirect()->route('admin.rutas.index')
            ->with('success', 'Ruta creada exitosamente');
    }

    public function show($id)
    {
        $ruta = Ruta::with('lugares')->findOrFail($id);

        return view('admin.rutas.show', compact('ruta'));
    }

    public function edit($id)
    {
        $ruta = Ruta::with('lugares')->findOrFail($id);
        $lugares = Lugar::all();

        return view('admin.rutas.edit', compact('ruta', 'lugares'));
    }

    public function update(Request $request, $id)
    {
        $ruta = Ruta::findOrFail($id);

        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
        ]);

        $ruta->update($validated);

        return redirect()->route('admin.rutas.index')
            ->with('success', 'Ruta actualizada exitosamente');
    }

    public function destroy($id)
    {
        $ruta = Ruta::findOrFail($id);
        $ruta->delete();

        return redirect()->route('admin.rutas.index')->with('success', 'Ruta eliminada exitosamente');
    }

    public function agregarLugar(Request $request, $id)
    {
        $ruta = Ruta::findOrFail($id);

        $imagenPath = null;

        if ($request->hasFile('imagen')) {
            $imagenPath = $request->file('imagen')->store('lugares', 'public');
        }

        // dd($id, Ruta::find($id));
        $ruta->lugares()->create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'orden' => $request->orden,
            'imagen' => $imagenPath,
        ]);

        return back()->with('success', 'Lugar agregado correctamente');
    }
}
