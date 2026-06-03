<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminGuiaController extends Controller
{
    public function index()
    {
        $guias = User::where('role', 'guia')->with('categoria')->get();

        return view('admin.guias.index', compact('guias'));
    }

    public function create()
    {
        $categorias = Categoria::all();

        return view('admin.guias.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'categoria_id' => 'nullable|exists:categorias,id',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'guia',
            'categoria_id' => $validated['categoria_id'] ?? null,
        ]);

        return redirect()->route('admin.guias.index')
            ->with('success', 'Guía creado exitosamente.');
    }

    public function edit($id)
    {
        $guia = User::where('role', 'guia')->findOrFail($id);
        $categorias = Categoria::all();

        return view('admin.guias.edit', compact('guia', 'categorias'));
    }

    public function update(Request $request, $id)
    {
        $guia = User::where('role', 'guia')->findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'categoria_id' => 'nullable|exists:categorias,id',
        ]);

        $guia->update($validated);

        if ($request->filled('password')) {
            $request->validate([
                'password' => 'required|string|min:8|confirmed',
            ]);
            $guia->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('admin.guias.index')
            ->with('success', 'Guía actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $guia = User::where('role', 'guia')->findOrFail($id);
        $guia->delete();

        return redirect()->route('admin.guias.index')
            ->with('success', 'Guía eliminado exitosamente.');
    }
}
