<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdministradorController extends Controller
{
    public function index()
    {
        $administradores = User::where('role', 'admin')->get();

        return view('admin.administradores.index', compact('administradores'));
    }

    public function create()
    {
        return view('admin.administradores.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'admin',
        ]);

        return redirect()->route('admin.administradores.index')->with('success', 'Administrador creado exitosamente');
    }

    public function edit($id)
    {
        $administrador = User::where('role', 'admin')->findOrFail($id);

        return view('admin.administradores.edit', compact('administrador'));
    }

    public function update(Request $request, $id)
    {
        $administrador = User::where('role', 'admin')->findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
        ]);

        $administrador->update($validated);

        if ($request->filled('password')) {
            $request->validate([
                'password' => 'required|string|min:8|confirmed',
            ]);
            $administrador->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('admin.administradores.index')->with('success', 'Administrador actualizado exitosamente');
    }

    public function destroy($id)
    {
        $administrador = User::where('role', 'admin')->findOrFail($id);
        $administrador->delete();

        return redirect()->route('admin.administradores.index')->with('success', 'Administrador eliminado exitosamente');
    }
}
