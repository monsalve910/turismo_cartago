<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tour;
use App\Models\Categoria;
use Barryvdh\DomPDF\Facade\Pdf;

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
                $request->fecha_fin
            ]);
        }

        if ($request->precio_min) {
            $query->where('precio', '>=', $request->precio_min);
        }

        $tours = $query->get();
        $categorias = Categoria::all();

        return view('reportes.index', compact('tours', 'categorias'));
    }

    public function estadisticas()
    {
        $promedios = Tour::selectRaw('categoria_id, AVG(precio) as promedio')
            ->groupBy('categoria_id')
            ->with('categoria')
            ->get();

        $recientes = Tour::orderBy('fecha', 'desc')->take(5)->get();

        $capacidadTotal = Tour::sum('capacidad');

        return view('reportes.estadisticas', compact(
            'promedios',
            'recientes',
            'capacidadTotal'
        ));
    }

    public function exportarPDF(Request $request)
    {
        $query = Tour::with('categoria');

        if ($request->categoria_id) {
            $query->where('categoria_id', $request->categoria_id);
        }

        $tours = $query->get();
        $categorias = Categoria::all();

        $pdf = Pdf::loadView('reportes.pdf', compact('tours', 'categorias'));

        return $pdf->download('reporte_tours.pdf');
    }

    public function porCategoria($id)
    {
        $categoria = Categoria::findOrFail($id);

        $tours = Tour::where('categoria_id', $id)->get();

        return view('reportes.categoria', compact('tours', 'categoria'));
    }
}