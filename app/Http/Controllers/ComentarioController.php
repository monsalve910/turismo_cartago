<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comentarios;
use Symfony\Component\HttpFoundation\Response;

class ComentarioController extends Controller
{
    public function store(Request $request)
    {
        // Validar los datos del comentario
        $validatedData = $request->validate([
            'user_id' => 'required|integer',
            'tour_id' => 'required|integer',
            'comentario' => 'required|string|max:255',
            'calificacion' => 'required|integer|min:1|max:5',
        ]);

        // Crear el comentario
        Comentarios::create([
            'user_id' => $validatedData['user_id'],
            'tour_id' => $validatedData['tour_id'],
            'comentario' => $validatedData['comentario'],
            'calificacion' => $validatedData['calificacion'],
        ]);

        // Redirigir o devolver una respuesta
        return response()->json(['message' => 'Comentario creado exitosamente'], 201);
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

        // Actualizar el comentario
        $comentario->update([
            'comentario' => $validatedData['comentario'],
            'calificacion' => $validatedData['calificacion'],
        ]);

        // Redirigir o devolver una respuesta
        return response()->json(['message' => 'Comentario actualizado exitosamente'], 200);
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

        // Eliminar el comentario
        $comentario->delete();

        // Redirigir o devolver una respuesta
        return response()->json(['message' => 'Comentario eliminado exitosamente'], 200);
    }

}


