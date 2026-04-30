<?php

namespace App\Http\Controllers;

use App\Models\Reservaciones;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservasController extends Controller
{
    public function index()
    {
        $reservas = Reservaciones::with('tour')
            ->where('user_id', Auth::id())
            ->paginate(10);

        return view('reservaciones.index', compact('reservas'));
    }

    public function create()
    {
        $tour = null;

        if (request()->has('tour_id')) {
            $tour = Tour::find(request()->tour_id);
        }

        $tours = Tour::all();

        return view('reservaciones.create', compact('tour', 'tours'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tour_id' => 'required|integer|exists:tours,id',
            'fecha' => 'required|date',
            'numero_personas' => 'required|integer|min:1',
        ]);

        Reservaciones::create([
            'user_id' => Auth::id(), // ✅ cambiado aquí
            'tour_id' => $validatedData['tour_id'],
            'fecha_reservacion' => $validatedData['fecha'],
            'cantidad_personas' => $validatedData['numero_personas'],
            'status' => 'pendiente',
        ]);

        return redirect()
            ->route('reservaciones.index')
            ->with('success', 'Reserva creada exitosamente. Pendiente de aprobación.');
    }

    public function admin()
    {
        $query = Reservaciones::with(['tour', 'user']);

        if (request('status')) {
            $query->where('status', request('status'));
        }

        $reservas = $query->orderBy('created_at', 'desc')->get();

        $pendientes = Reservaciones::where('status', 'pendiente')->count();

        return view('admin.reservaciones.admin', compact('reservas', 'pendientes'));
    }

    public function aprobar($id)
    {
        $reserva = Reservaciones::findOrFail($id);

        if ($reserva->status !== 'pendiente') {
            return back()->with('error', 'La reserva ya fue procesada');
        }

        $reserva->update([
            'status' => 'aprobado' // ⚠️ ajusta al ENUM
        ]);

        return back()->with('success', 'Reserva aprobada correctamente');
    }

    public function cancelar($id)
    {
        $reserva = Reservaciones::findOrFail($id);

        if ($reserva->status !== 'pendiente') {
            return back()->with('error', 'La reserva ya fue procesada');
        }

        $reserva->update([
            'status' => 'cancelada'
        ]);

        return back()->with('success', 'Reserva cancelada correctamente');
    }

    public function finalizar($id)
    {
        $reserva = Reservaciones::findOrFail($id);

        $reserva->update([
            'status' => 'finalizado' // ⚠️ ajusta al ENUM
        ]);

        return back()->with('success', 'Reserva finalizada correctamente');
    }

    public function misReservas()
    {
        $reservas = Reservaciones::where('user_id', Auth::id())
            ->with('tour')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('reservaciones.index', compact('reservas'));
    }
}