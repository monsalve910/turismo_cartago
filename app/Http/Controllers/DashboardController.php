<?php

namespace App\Http\Controllers;

use App\Models\Reservaciones;
use App\Models\Tour;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if (($user->role ?? '') === 'admin') {
            $totalTours = Tour::count();
            $totalReservas = Reservaciones::count();
            $totalUsuarios = User::count();
            $recentTours = Tour::with('categoria')->latest()->take(5)->get();

            return view('dashboard', compact('totalTours', 'totalReservas', 'totalUsuarios', 'recentTours'));
        }

        $misReservas = Reservaciones::where('user_id', $user->id)->latest()->take(5)->get();
        $availableTours = Tour::with('categoria')->where('fecha', '>=', now())->take(3)->get();

        return view('dashboard', compact('misReservas', 'availableTours'));
    }
}
