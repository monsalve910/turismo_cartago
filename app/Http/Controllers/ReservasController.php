<?php

namespace App\Http\Controllers;

use App\Models\GuiaDisponibilidad;
use App\Models\Reservaciones;
use App\Models\Tour;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservasController extends Controller
{
    public function index()
    {
        $reservas = Reservaciones::with('tour')
            ->where('user_id', auth()->id())
            ->orderByRaw("FIELD(status, 'pendiente', 'aprobada', 'finalizada', 'cancelada')")
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('reservaciones.index', compact('reservas'));
    }

    public function create()
    {
        $tour = null;

        if (request('tour_id')) {
            $tour = Tour::findOrFail(request('tour_id'));
        }

        $tours = Tour::all();

        return view('reservaciones.create', compact('tour', 'tours'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tour_id' => 'required|exists:tours,id',
            'fecha' => 'required|date|after_or_equal:today',
            'numero_personas' => 'required|integer|min:1',
        ]);

        $tour = Tour::findOrFail($validated['tour_id']);

        if ($validated['numero_personas'] > $tour->capacidad) {
            return back()->withErrors(['numero_personas' => 'La cantidad de personas no puede exceder la capacidad del tour (' . $tour->capacidad . ').']);
        }

        if (\Carbon\Carbon::parse($tour->fecha)->isBefore(today())) {
            return back()->with('error', 'No puedes reservar un tour cuya fecha ya pasó.');
        }

        $reservacion = Reservaciones::create([
            'user_id' => auth()->id(),
            'tour_id' => $validated['tour_id'],
            'fecha_reservacion' => $validated['fecha'],
            'cantidad_personas' => $validated['numero_personas'],
            'status' => 'aprobada',
        ]);

        $this->asignarGuia($reservacion, $validated['fecha']);

        return redirect()->route('reservaciones.index')
            ->with('success', 'Reservación creada y aprobada automáticamente.');
    }

    public function misReservas($user_id)
    {
        $reservas = Reservaciones::with('tour')
            ->where('user_id', auth()->id())
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

        return view('admin.reservaciones.admin', compact('reservas', 'pendientes'));
    }

    public function aprobar($id)
    {
        $reservacion = Reservaciones::with('user')->findOrFail($id);

        if ($reservacion->status !== 'pendiente') {
            return back()->withErrors(['error' => 'Solo se pueden aprobar reservaciones pendientes.']);
        }

        $reservacion->update(['status' => 'aprobada']);

        $this->asignarGuia($reservacion, $reservacion->fecha_reservacion);

        return back()->with('success', 'Reservación aprobada y guía asignado exitosamente.');
    }

    public function cancelar(Request $request, $id)
    {
        $reservacion = Reservaciones::with(['tour', 'user'])->findOrFail($id);
        $user = auth()->user();

        if ($user->role !== 'admin' && $reservacion->user_id !== $user->id) {
            abort(403, 'No tienes permiso para cancelar esta reservación.');
        }

        $cancelables = $user->role === 'admin'
            ? ['pendiente', 'aprobada', 'iniciada']
            : ['pendiente', 'aprobada'];

        if (!in_array($reservacion->status, $cancelables)) {
            return back()->withErrors(['error' => 'Esta reservación no puede ser cancelada porque ya está ' . $reservacion->status . '.']);
        }

        if ($user->role !== 'admin') {
            $tourDate = Carbon::parse($reservacion->tour->fecha);
            $daysUntilTour = now()->startOfDay()->diffInDays($tourDate, false);

            if ($daysUntilTour < 2) {
                return back()->withErrors(['error' => 'No puedes cancelar con menos de 2 días de anticipación.']);
            }
        }

        $reservacion->update(['status' => 'cancelada']);

        return back()->with('success', 'Reservación cancelada exitosamente.');
    }

    private function asignarGuia(Reservaciones $reservacion, $fecha, $hora = null)
    {
        $diaSemana = Carbon::parse($fecha)->dayOfWeek;

        $guiasIds = GuiaDisponibilidad::where('dia_semana', $diaSemana)
            ->where('activo', true)
            ->pluck('user_id');

        if ($guiasIds->isEmpty()) {
            return;
        }

        $ocupadosIds = Reservaciones::whereIn('guia_id', $guiasIds)
            ->where('fecha_tour', $fecha)
            ->whereIn('status', ['aprobada', 'iniciada'])
            ->when($hora, fn($q) => $q->where('hora_tour', $hora))
            ->pluck('guia_id')
            ->unique();

        $libresIds = $guiasIds->diff($ocupadosIds);

        if ($libresIds->isEmpty()) {
            return;
        }

        $carga = Reservaciones::whereIn('guia_id', $libresIds)
            ->where('fecha_tour', $fecha)
            ->whereIn('status', ['aprobada', 'iniciada'])
            ->selectRaw('guia_id, COUNT(*) as total')
            ->groupBy('guia_id')
            ->pluck('total', 'guia_id');

        $menorCarga = $libresIds->map(fn($id) => $carga[$id] ?? 0)->min();

        $candidatos = $libresIds->filter(fn($id) => ($carga[$id] ?? 0) === $menorCarga);

        $seleccionado = $candidatos->count() > 1 ? $candidatos->random() : $candidatos->first();

        $reservacion->update([
            'guia_id' => $seleccionado,
            'fecha_tour' => $fecha,
            'hora_tour' => $hora,
        ]);
    }
}
