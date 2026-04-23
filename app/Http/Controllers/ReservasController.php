<?php

namespace App\Http\Controllers;

use App\Models\Reservaciones;
use Illuminate\Http\Request;

class ReservasController extends Controller
{
    public function index()
    {
        $reservas = Reservaciones::all();

        return response()->json($reservas);
    }

    public function create()
    {
        return view('reservaciones.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'tour_id' => 'required|integer',
            'fecha_reservacion' => 'required|date',
            'cantidad_personas' => 'required|integer|min:1'
        ]);
        Reservaciones::create([
            'user_id' => $request->user_id,
            'tour_id' => $request->tour_id,
            'fecha_reservacion' => $request->fecha_reservacion,
            'cantidad_personas' => $request->cantidad_personas,

        ]);

        return response()->json(['message' => 'Reserva creada exitosamente']);
    }
    public function pendientes()
    {



        $reservas = Reservaciones::where('status', 'pendiente')->get();
        return response()->json($reservas);
    }
    public function aprobar($id)
    {

        $reserva = Reservaciones::findOrFail($id);

        if ($reserva->status !== 'pendiente') {
            return response()->json([
                'error' => 'La reserva ya fue procesada'
            ], 400);
        }
        $reserva->status = 'activa';
        $reserva->save();

        return response()->json(['message' => 'Reserva aprobada']);
    }
    public function cancelar($id)
    {

        $reserva = Reservaciones::findOrFail($id);

        if ($reserva->status !== 'pendiente') {
            return response()->json([
                'error' => 'La reserva ya fue procesada'
            ], 400);
        }
        $reserva->status = 'cancelada';
        $reserva->save();

        return response()->json(['message' => 'Reserva cancelada']);
    }
    public function finalizar($id)
    {
        $reserva = Reservaciones::findOrFail($id);

        $reserva->status = 'finalizada';
        $reserva->save();

        return response()->json(['message' => 'Reserva finalizada']);
    }
    public function misReservas($user_id)
    {
        return response()->json(Reservaciones::where('user_id', $user_id)->get());
    }
}
