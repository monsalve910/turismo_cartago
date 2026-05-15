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
            foreach ($request->lugares as $item) {
                if (isset($item['lugar_id']) && isset($item['orden'])) {
                    Lugar::where('id', $item['lugar_id'])->update([
                        'ruta_id' => $ruta->id,
                        'orden' => $item['orden'],
                    ]);
                }
            }
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

        $nuevosIds = [];
        if ($request->has('lugares')) {
            foreach ($request->lugares as $item) {
                if (isset($item['lugar_id']) && isset($item['orden'])) {
                    $nuevosIds[] = $item['lugar_id'];
                    Lugar::where('id', $item['lugar_id'])->update([
                        'ruta_id' => $ruta->id,
                        'orden' => $item['orden'],
                    ]);
                }
            }
        }

        Lugar::where('ruta_id', $ruta->id)
            ->whereNotIn('id', $nuevosIds)
            ->update(['ruta_id' => null, 'orden' => null]);

        return redirect()->route('admin.rutas.index')
            ->with('success', 'Ruta actualizada exitosamente');
    }

    public function destroy($id)
    {
        $ruta = Ruta::findOrFail($id);
        $ruta->delete();

        return redirect()->route('admin.rutas.index')->with('success', 'Ruta eliminada exitosamente');
    }
}
