<?php

use App\Http\Controllers\AdminCategoriaController;
use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\AdminGuiaController;
use App\Http\Controllers\AdminLugarController;
use App\Http\Controllers\AdminRutaController;
use App\Http\Controllers\AdminTourController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\GuiaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\ReservasController;
use App\Http\Controllers\TourController;
use Illuminate\Support\Facades\Route;

// PUBLIC ROUTES
Route::get('/', [HomeController::class, 'index']);

Route::resource('tours', TourController::class)->only(['index', 'show']);
Route::resource('categorias', CategoriaController::class)->only(['index', 'show']);

// AUTH ROUTES (any authenticated user)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware(['verified'])
        ->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/reservaciones', [ReservasController::class, 'index'])->name('reservaciones.index');
    Route::get('/reservaciones/create', [ReservasController::class, 'create'])->name('reservaciones.create');
    Route::post('/reservaciones', [ReservasController::class, 'store'])->name('reservaciones.store');
    Route::get('/reservaciones/mis-reservas/{user_id}', [ReservasController::class, 'misReservas'])->name('reservaciones.misReservas');
     Route::post('/reservaciones/{id}/cancelar', [ReservasController::class, 'cancelar'])->name('reservaciones.cancelar');

    Route::post('/comentarios', [ComentarioController::class, 'store'])->name('comentarios.store');
    Route::put('/comentarios/{id}', [ComentarioController::class, 'update'])->name('comentarios.update');
    Route::delete('/comentarios/{id}', [ComentarioController::class, 'destroy'])->name('comentarios.destroy');
});

// GUIDE ROUTES (auth + guia middleware)
Route::middleware(['auth', 'guia'])->prefix('guia')->name('guia.')->group(function () {
    Route::get('/dashboard', [GuiaController::class, 'dashboard'])->name('dashboard');
    Route::post('/reservaciones/{id}/iniciar', [GuiaController::class, 'iniciar'])->name('reservaciones.iniciar');
    Route::post('/reservaciones/{id}/finalizar', [GuiaController::class, 'finalizar'])->name('reservaciones.finalizar');
});

// ADMIN ROUTES (auth + admin middleware)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard');

    Route::resource('tours', AdminTourController::class)->except(['show']);
    Route::resource('categorias', AdminCategoriaController::class);
    Route::resource('rutas', AdminRutaController::class);
    Route::resource('lugares', AdminLugarController::class);

    Route::resource('administradores', AdministradorController::class);
    Route::resource('guias', AdminGuiaController::class);

    Route::get('reservaciones', [ReservasController::class, 'admin'])->name('reservaciones.index');
    Route::post('reservaciones/{id}/aprobar', [ReservasController::class, 'aprobar'])->name('reservaciones.aprobar');
    Route::post('/reservaciones/{id}/cancelar', [ReservasController::class, 'cancelar'])->name('reservaciones.cancelar');

    Route::get('reportes', [ReporteController::class, 'index'])->name('reportes.index');
    Route::get('reportes/estadisticas', [ReporteController::class, 'estadisticas'])->name('reportes.estadisticas');
    Route::get('reportes/pdf', [ReporteController::class, 'exportarPDF'])->name('reportes.pdf');
    Route::get('reportes/categoria/{id}', [ReporteController::class, 'porCategoria'])->name('reportes.categoria');
});

require __DIR__.'/auth.php';
