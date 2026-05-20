<?php

namespace App\Http\Controllers;

use App\Models\Reservaciones;

class GuiaController extends Controller
{
    public function dashboard()
    {
        $reservaciones = Reservaciones::with(['tour', 'user'])
            ->where('guia_id', auth()->id())
            ->orderByRaw("FIELD(status, 'aprobada', 'iniciada', 'finalizada', 'cancelada')")
            ->orderBy('fecha_tour', 'asc')
            ->paginate(15);

        $pendientes = $reservaciones->where('status', 'aprobada')->count();
        $enCurso = $reservaciones->where('status', 'iniciada')->count();
        $finalizados = $reservaciones->where('status', 'finalizada')->count();

        return view('guia.dashboard', compact('reservaciones', 'pendientes', 'enCurso', 'finalizados'));
    }

    public function iniciar($id)
    {
        $reservacion = Reservaciones::where('guia_id', auth()->id())->findOrFail($id);

        if ($reservacion->status !== 'aprobada') {
            return back()->with('error', 'Solo puedes iniciar tours en estado aprobado.');
        }

        $reservacion->update(['status' => 'iniciada']);

        return back()->with('success', 'Tour iniciado correctamente.');
    }

    public function finalizar($id)
    {
        $reservacion = Reservaciones::where('guia_id', auth()->id())->findOrFail($id);

        if ($reservacion->status !== 'iniciada') {
            return back()->with('error', 'Solo puedes finalizar tours en estado iniciado.');
        }

        $reservacion->update(['status' => 'finalizada']);

        return back()->with('success', 'Tour finalizado correctamente.');
    }
}
