<?php

namespace App\Http\Controllers;

use App\Models\Lugar;
use Illuminate\Http\Request;
use App\Models\Ruta;

class AdminLugarController extends Controller
{
    public function index()
    {
        $lugares = Lugar::all();

        return view('admin.lugares.index', compact('lugares'));
    }

    public function create()
    {
        $rutas = Ruta::all();
        return view('admin.lugares.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'ubicacion' => 'required|string',
        ]);

        Lugar::create($validated);

        return redirect()->route('admin.lugares.index')->with('success', 'Lugar creado exitosamente');
    }

    public function show($id)
    {
        $lugar = Lugar::findOrFail($id);

        return view('admin.lugares.show', compact('lugar'));
    }

    public function edit($id)
    {
        $lugar = Lugar::findOrFail($id);
        $rutas = Ruta::all();

        return view('admin.lugares.edit', compact('lugar', 'rutas'));
    }

    public function update(Request $request, $id)
    {
        $lugar = Lugar::findOrFail($id);

        $validated = $request->validate([
            'ruta_id' => 'required|exists:rutas,id',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'orden' => 'required|integer|min:1',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // subir imagen nueva
        if ($request->hasFile('imagen')) {

            $path = $request->file('imagen')->store('lugares', 'public');

            $validated['imagen'] = $path;
        }

        $lugar->update($validated);

        return redirect()
            ->route('admin.lugares.index')
            ->with('success', 'Lugar actualizado exitosamente');
    }

    public function destroy($id)
    {
        $lugar = Lugar::findOrFail($id);
        $lugar->delete();

        return redirect()->route('admin.lugares.index')->with('success', 'Lugar eliminado exitosamente');
    }
}
