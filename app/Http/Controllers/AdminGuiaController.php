<?php

namespace App\Http\Controllers;

use App\Models\GuiaDisponibilidad;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminGuiaController extends Controller
{
    public function index()
    {
        $guias = User::where('role', 'guia')->with('guiaDisponibilidad')->get();

        return view('admin.guias.index', compact('guias'));
    }

    public function create()
    {
        return view('admin.guias.create');
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
            'role' => 'guia',
        ]);

        return redirect()->route('admin.guias.index')
            ->with('success', 'Guía creado exitosamente.');
    }

    public function edit($id)
    {
        $guia = User::where('role', 'guia')->findOrFail($id);

        return view('admin.guias.edit', compact('guia'));
    }

    public function update(Request $request, $id)
    {
        $guia = User::where('role', 'guia')->findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($guia->id)],
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

    public function disponibilidad($id)
    {
        $guia = User::where('role', 'guia')->findOrFail($id);
        $disponibilidad = GuiaDisponibilidad::where('user_id', $id)->get()->keyBy('dia_semana');

        $dias = [
            0 => 'Domingo',
            1 => 'Lunes',
            2 => 'Martes',
            3 => 'Miércoles',
            4 => 'Jueves',
            5 => 'Viernes',
            6 => 'Sábado',
        ];

        return view('admin.guias.disponibilidad', compact('guia', 'disponibilidad', 'dias'));
    }

    public function updateDisponibilidad(Request $request, $id)
    {
        $guia = User::where('role', 'guia')->findOrFail($id);

        $validated = $request->validate([
            'disponibilidad' => 'required|array',
            'disponibilidad.*' => 'boolean',
        ]);

        $diasEnviados = array_keys($validated['disponibilidad']);

        GuiaDisponibilidad::where('user_id', $id)->delete();

        foreach ($diasEnviados as $dia) {
            GuiaDisponibilidad::create([
                'user_id' => $id,
                'dia_semana' => (int) $dia,
                'activo' => true,
            ]);
        }

        return redirect()->route('admin.guias.index')
            ->with('success', 'Disponibilidad actualizada exitosamente.');
    }
}
