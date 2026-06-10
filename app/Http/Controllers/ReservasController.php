<?php

namespace App\Http\Controllers;

use App\Jobs\FinalizarReservacionJob;
use App\Models\Reservaciones;
use App\Models\Tour;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservasController extends Controller
{
    public function index()
    {
        $reservas = Reservaciones::with(['tour.guia', 'tour.categoria'])
            ->where('user_id', Auth::id())
            ->orderByRaw("FIELD(status, 'pendiente', 'aprobada', 'finalizada', 'cancelada')")
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('reservaciones.index', compact('reservas'));
    }

    public function create()
    {
        $tour = null;

        if (request('tour_id')) {
            $tour = Tour::with('horarios')->findOrFail(request('tour_id'));
        }

        $tours = Tour::whereDate('fecha', '>=', today())
            ->where('disponible', 1)
            ->orderBy('fecha', 'asc')
            ->get();

        return view('reservaciones.create', compact('tour', 'tours'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tour_id' => 'required|exists:tours,id',
            'numero_personas' => 'required|integer|min:1',
            'hora_tour' => 'required',
        ]);

        $tour = Tour::findOrFail($validated['tour_id']);

        // Validar que el horario seleccionado pertenezca al tour
        $horarioValido = $tour->horarios()->where('hora', $validated['hora_tour'])->exists();
        if (!$horarioValido) {
            return back()->withErrors([
                'hora_tour' => 'El horario seleccionado no esta disponible para este tour.'
            ]);
        }

        // Validar que el tour no est� vencido
        if (Carbon::parse($tour->fecha)->isBefore(today())) {
            return back()->with(
                'error',
                'No puedes reservar un tour cuya fecha ya paso.'
            );
        }

        // Calcular cupos ya reservados para ese horario
        $reservados = Reservaciones::where('tour_id', $tour->id)
            ->where('hora_tour', $validated['hora_tour'])
            ->whereIn('status', ['aprobada', 'iniciada'])
            ->sum('cantidad_personas');

        $cuposDisponibles = $tour->capacidad - $reservados;

        // Validar capacidad disponible
        if ($validated['numero_personas'] > $cuposDisponibles) {
            return back()->withErrors([
                'numero_personas' =>
                    'Solo quedan ' . $cuposDisponibles . ' cupos disponibles para este horario.'
            ]);
        }

        // Crear reservaci�n
        $reservacion = Reservaciones::create([
            'user_id' => Auth::id(),
            'tour_id' => $tour->id,
            'fecha_reservacion' => now(),
            'fecha_tour' => $tour->fecha,
            'hora_tour' => $validated['hora_tour'],
            'cantidad_personas' => $validated['numero_personas'],
            'status' => 'aprobada',
            'guia_id' => $tour->guia_id,
        ]);

        $delay = Carbon::parse($reservacion->fecha_tour)->addDay()->startOfDay();
        FinalizarReservacionJob::dispatch($reservacion)->delay($delay);

        return redirect()
            ->route('reservaciones.index')
            ->with(
                'success',
                'Reservacion creada y aprobada.'
            );
    }

    public function misReservas($user_id)
    {
        $reservas = Reservaciones::with('tour')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('reservaciones.index', compact('reservas'));
    }

    public function admin()
    {
        $reservas = Reservaciones::with(['tour', 'user', 'guia'])
            ->when(request('status'), function ($q, $status) {
                $q->where('status', $status);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        $pendientes = Reservaciones::where('status', 'pendiente')->count();

        return view(
            'admin.reservaciones.admin',
            compact('reservas', 'pendientes')
        );
    }

    public function aprobar(int $id)
    {
        $reservacion = Reservaciones::with('user', 'tour')
            ->findOrFail($id);

        if ($reservacion->status !== 'pendiente') {
            return back()->withErrors([
                'error' =>
                    'Solo se pueden aprobar reservaciones pendientes.'
            ]);
        }

        $reservacion->update([
            'status' => 'aprobada',
            'guia_id' => $reservacion->tour->guia_id,
        ]);

        $delay = Carbon::parse($reservacion->fecha_tour)->addDay()->startOfDay();
        FinalizarReservacionJob::dispatch($reservacion)->delay($delay);

        return back()->with(
            'success',
            'Reservacion aprobada exitosamente.'
        );
    }

    public function cancelar(Request $request,int $id)
    {
        $reservacion = Reservaciones::with(['tour', 'user'])
            ->findOrFail($id);

        $user = Auth::user();

        if (
            $user->role !== 'admin' &&
            $reservacion->user_id !== $user->id
        ) {
            abort(
                403,
                'No tienes permiso para cancelar esta reservacion.'
            );
        }

        $cancelables = $user->role === 'admin'
            ? ['pendiente', 'aprobada', 'iniciada']
            : ['pendiente', 'aprobada'];

        if (!in_array($reservacion->status, $cancelables)) {
            return back()->withErrors([
                'error' =>
                    'Esta reservacion no puede ser cancelada porque ya esta ' .
                    $reservacion->status . '.'
            ]);
        }

        if ($user->role !== 'admin') {

            $tourDate = Carbon::parse($reservacion->tour->fecha);

            $daysUntilTour = now()
                ->startOfDay()
                ->diffInDays($tourDate, false);

            if ($daysUntilTour < 2) {
                return back()->withErrors([
                    'error' =>
                        'No puedes cancelar con menos de 2 dias de anticipacion.'
                ]);
            }
        }

        $reservacion->update([
            'status' => 'cancelada'
        ]);

        return back()->with(
            'success',
            'Reservacion cancelada exitosamente.'
        );
    }
}
