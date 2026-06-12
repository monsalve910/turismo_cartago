<?php

namespace App\Http\Controllers;

use App\Models\Reservaciones;
use App\Models\Ruta;
use App\Models\Tour;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($user->role === 'guia') {
            return redirect()->route('guia.dashboard');
        }

        $misReservas = Reservaciones::where('user_id', auth()->id())
            ->with(['tour', 'guia'])
            ->orderBy('fecha_reservacion', 'desc')
            ->get();

        $availableTours = Tour::with('categoria')->orderBy('fecha', 'desc')->take(6)->get();

        return view('dashboard', compact('misReservas', 'availableTours'));
    }

    public function adminDashboard()
    {
        $totalTours = Tour::count();
        $totalReservas = Reservaciones::count();
        $totalUsuarios = User::count();
        $totalRutas = Ruta::count();
        $totalGuias = User::where('role', 'guia')->count();
        $recentReservas = Reservaciones::with(['tour', 'user'])
            ->latest('created_at')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalTours',
            'totalReservas',
            'totalUsuarios',
            'totalRutas',
            'totalGuias',
            'recentReservas'
        ));
    }
}
