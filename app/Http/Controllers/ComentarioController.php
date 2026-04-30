<?php

namespace App\Http\Controllers;

use App\Models\Comentarios;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public function store(Request $request)
    {
        // Validar los datos del comentario
        $validatedData = $request->validate([
            'tour_id' => 'required|integer',
            'comentario' => 'required|string|max:255',
            'calificacion' => 'required|integer|min:1|max:5',
        ]);

        // Crear el comentario usando el usuario autenticado
        Comentarios::create([
            'user_id' => auth()->id(),
            'tour_id' => $validatedData['tour_id'],
            'comentario' => $validatedData['comentario'],
            'calificacion' => $validatedData['calificacion'],
        ]);

        return back()->with('success', 'Comentario creado exitosamente');
    }

    // Editar un comentario existente
    public function update(Request $request, $id)
    {
        // Validar los datos del comentario
        $validatedData = $request->validate([
            'comentario' => 'required|string|max:255',
            'calificacion' => 'required|integer|min:1|max:5',
        ]);

        // Encontrar el comentario por su ID
        $comentario = Comentarios::findOrFail($id);

        // Verificar que el usuario sea el dueño del comentario
        if ($comentario->user_id !== auth()->id()) {
            return back()->with('error', 'No tienes permiso para editar este comentario');
        }

        // Actualizar el comentario
        $comentario->update([
            'comentario' => $validatedData['comentario'],
            'calificacion' => $validatedData['calificacion'],
        ]);

        return back()->with('success', 'Comentario actualizado exitosamente');
    }

    public function comentariosPorUsuarioYTour($tour_id, $user_id)
    {
        $comentarios = Comentarios::where('tour_id', $tour_id)
            ->where('user_id', $user_id)
            ->get();

        return response()->json($comentarios, 200);
    }

    // Eliminar un comentario
    public function destroy($id)
    {
        // Encontrar el comentario por su ID
        $comentario = Comentarios::findOrFail($id);

        // Verificar que el usuario sea el dueño o administrador
        if ($comentario->user_id !== auth()->id() && ! (auth()->user()->role === 'admin')) {
            return back()->with('error', 'No tienes permiso para eliminar este comentario');
        }

        // Eliminar el comentario
        $comentario->delete();

        return back()->with('success', 'Comentario eliminado exitosamente');
    }
}
