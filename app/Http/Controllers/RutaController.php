<?php

namespace App\Http\Controllers;

use App\Models\Ruta;
use App\Models\Lugar;
use Illuminate\Http\Request;

class RutaController extends Controller
{
    public function index()
    {
        $rutas = Ruta::all();
        return view('rutas.index', compact('rutas'));
    }

    public function create()
    {
        return view('rutas.create');
    }

    public function store(Request $request)
    {
        $ruta = Ruta::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('rutas.edit', $ruta->id);
    }

    public function show($id)
    {
        $ruta = Ruta::with('lugares')->findOrFail($id);
        return view('rutas.show', compact('ruta'));
    }

    public function edit($id)
    {
        $ruta = Ruta::findOrFail($id);
        return view('rutas.edit', compact('ruta'));
    }

    public function update(Request $request, $id)
    {
        $ruta = Ruta::findOrFail($id);
        $ruta->update($request->only('nombre', 'descripcion'));

        return redirect()->route('rutas.index');
    }

    public function destroy($id)
    {
        $ruta = Ruta::findOrFail($id);
        $ruta->delete();

        return redirect()->route('rutas.index');
    }

    //  Agregar lugar a la ruta
    public function agregarLugar(Request $request, $ruta_id)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'orden' => 'required|integer|min:1',
            'imagen' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $rutaImagen = null;

        if ($request->hasFile('imagen')) {
            $rutaImagen = $request->file('imagen')->store('lugares', 'public');
        }

        Lugar::create([
            'ruta_id' => $ruta_id,
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'orden' => $request->orden,
            'imagen' => $rutaImagen
        ]);

        return back();
    }
    public function eliminarLugar($id)
    {
        $lugar = Lugar::findOrFail($id);

        // (opcional) eliminar imagen del storage
        if ($lugar->imagen) {
            \Storage::disk('public')->delete($lugar->imagen);
        }

        $lugar->delete();

        return back();
    }
}
