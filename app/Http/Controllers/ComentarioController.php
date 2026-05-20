<?php

namespace App\Http\Controllers;

use App\Models\Comentarios;
use App\Models\Reservaciones;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComentarioController extends Controller
{
    public function store(Request $request)
    {
        // Validar datos
        $validatedData = $request->validate([
            'tour_id' => 'required|integer|exists:tours,id',
            'comentario' => 'required|string|max:255',
            'calificacion' => 'required|integer|min:1|max:5',
        ]);

        // Buscar reservación del usuario para ese tour
        $reservacion = Reservaciones::where('user_id', Auth::id())
            ->where('tour_id', $validatedData['tour_id'])
            ->whereIn('status', ['aprobada', 'finalizada'])
            ->orderBy('fecha_tour', 'desc')
            ->first();

        // Si nunca reservó
        if (!$reservacion) {
            return back()->with(
                'error',
                'Solo puedes comentar tours que hayas reservado.'
            );
        }

        $fechaTour = Carbon::parse($reservacion->fecha_tour);

        // Si el tour aún no ocurre
        if ($fechaTour->isFuture()) {
            return back()->with(
                'error',
                'Solo puedes comentar después de realizar el tour.'
            );
        }

        // Si ya pasó más de 1 mes
        if (now()->greaterThan($fechaTour->copy()->addMonth())) {
            return back()->with(
                'error',
                'El tiempo para comentar este tour ya expiró.'
            );
        }

        // Verificar si ya comentó
        $yaComento = Comentarios::where('user_id', Auth::id())
            ->where('tour_id', $validatedData['tour_id'])
            ->exists();

        if ($yaComento) {
            return back()->with(
                'error',
                'Ya has comentado este tour.'
            );
        }

        // Crear comentario
        Comentarios::create([
            'user_id' => Auth::id(),
            'tour_id' => $validatedData['tour_id'],
            'comentario' => $validatedData['comentario'],
            'calificacion' => $validatedData['calificacion'],
        ]);

        return back()->with(
            'success',
            'Comentario creado exitosamente'
        );
    }

    // Editar comentario
    public function update(Request $request, int $id)
    {
        $validatedData = $request->validate([
            'comentario' => 'required|string|max:255',
            'calificacion' => 'required|integer|min:1|max:5',
        ]);

        $comentario = Comentarios::findOrFail($id);

        // Verificar propietario
        if ($comentario->user_id !== Auth::id()) {
            return back()->with(
                'error',
                'No tienes permiso para editar este comentario'
            );
        }

        $comentario->update([
            'comentario' => $validatedData['comentario'],
            'calificacion' => $validatedData['calificacion'],
        ]);

        return back()->with(
            'success',
            'Comentario actualizado exitosamente'
        );
    }

    public function comentariosPorUsuarioYTour(
        int $tour_id,
        int $user_id
    ) {

        $comentarios = Comentarios::where('tour_id', $tour_id)
            ->where('user_id', $user_id)
            ->get();

        return response()->json($comentarios, 200);
    }

    // Eliminar comentario
    public function destroy(int $id)
    {
        $comentario = Comentarios::findOrFail($id);

        // Verificar permisos
        if (
            $comentario->user_id !== Auth::id() &&
            !(Auth::user()->role === 'admin')
        ) {
            return back()->with(
                'error',
                'No tienes permiso para eliminar este comentario'
            );
        }

        $comentario->delete();

        return back()->with(
            'success',
            'Comentario eliminado exitosamente'
        );
    }
}