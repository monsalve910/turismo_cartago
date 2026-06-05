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

        if ($request->has('lugares')) {
            $syncData = [];
            foreach ($request->lugares as $item) {
                if (isset($item['lugar_id']) && isset($item['orden'])) {
                    $syncData[$item['lugar_id']] = ['orden' => $item['orden']];
                }
            }
            $ruta->lugares()->sync($syncData);
        }

        return redirect()->route('admin.rutas.index')
            ->with('success', 'Ruta creada exitosamente.');
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

        $syncData = [];
        if ($request->has('lugares')) {
            foreach ($request->lugares as $item) {
                if (isset($item['lugar_id']) && isset($item['orden'])) {
                    $syncData[$item['lugar_id']] = ['orden' => $item['orden']];
                }
            }
        }
        $ruta->lugares()->sync($syncData);

        return redirect()->route('admin.rutas.index')
            ->with('success', 'Ruta actualizada exitosamente');
    }

    public function destroy($id)
    {
        $ruta = Ruta::findOrFail($id);
        $ruta->tours()->delete(); // Elimina todos los tours con ese ruta_id
        $ruta->delete();

        return redirect()->route('admin.rutas.index')->with('success', 'Ruta eliminada exitosamente');
    }
}
