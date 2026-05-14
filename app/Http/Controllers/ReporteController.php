<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Tour;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\Reservaciones;
use App\Models\User;

class ReporteController extends Controller
{
    public function index(Request $request)
    {
        $query = Tour::with('categoria');

        if ($request->categoria_id) {
            $query->where('categoria_id', $request->categoria_id);
        }

        if ($request->fecha_inicio && $request->fecha_fin) {
            $query->whereBetween('fecha', [
                $request->fecha_inicio,
                $request->fecha_fin,
            ]);
        }

        if ($request->precio_min) {
            $query->where('precio', '>=', $request->precio_min);
        }

        $tours = $query->get();
        $categorias = Categoria::all();

        return view('admin.reportes.index', compact('tours', 'categorias'));
    }

    public function estadisticas()
    {
        $totalTours = Tour::count();
        $totalReservas = Reservaciones::count();
        $totalUsuarios = User::count();
        $pendientes = Reservaciones::where('estado', 'pendiente')->count();

        $reservasPorEstado = Reservaciones::selectRaw('estado, COUNT(*) as total')
            ->groupBy('estado')
            ->get();

        $reservasPorCategoria = Reservaciones::selectRaw('categorias.name as categoria, COUNT(reservaciones.id) as total')
            ->join('tours', 'reservaciones.tour_id', '=', 'tours.id')
            ->join('categorias', 'tours.categoria_id', '=', 'categorias.id')
            ->groupBy('categorias.name')
            ->get();

        return view('admin.reportes.estadisticas', compact(
            'totalTours',
            'totalReservas',
            'totalUsuarios',
            'pendientes',
            'reservasPorEstado',
            'reservasPorCategoria'
        ));
    }

    public function exportarPDF(Request $request)
    {
        $query = Reservaciones::with(['tour', 'user']);

        // Filtrar por categoría
        if ($request->filled('categoria_id')) {
            $query->whereHas('tour', function ($q) use ($request) {
                $q->where('categoria_id', $request->categoria_id);
            });
        }

        // Filtrar por fechas
        if ($request->fecha_inicio && $request->fecha_fin) {
            $query->whereHas('tour', function ($q) use ($request) {
                $q->whereBetween('fecha', [
                    $request->fecha_inicio,
                    $request->fecha_fin
                ]);
            });
        }

        // Filtrar por precio mínimo
        if ($request->precio_min) {
            $query->whereHas('tour', function ($q) use ($request) {
                $q->where('precio', '>=', $request->precio_min);
            });
        }

        $reservas = $query->orderBy('created_at', 'desc')->get();

        $pdf = Pdf::loadView('admin.reportes.pdf', compact('reservas'));

        return $pdf->download('reporte_reservas.pdf');
    }

    public function porCategoria($id)
    {
        $categoria = Categoria::findOrFail($id);

        $tours = Tour::where('categoria_id', $id)->get();

        return view('admin.reportes.categoria', compact('tours', 'categoria'));
    }
}
