<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RutaController;
Route::resource('rutas', RutaController::class);
Route::post('rutas/{id}/lugares', [RutaController::class, 'agregarLugar'])->name('rutas.lugares');
Route::delete('/lugares/{id}', [RutaController::class, 'eliminarLugar'])->name('lugares.destroy');
use App\Http\Controllers\ReservasController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/reservaciones', [ReservasController::class, 'index']);
Route::get('/reservaciones/create', [ReservasController::class, 'create']);
Route::post('/reservaciones', [ReservasController::class, 'store']);
Route::get('/reservaciones/pendientes', [ReservasController::class, 'pendientes']);

Route::post('/reservaciones/{id}/aprobar', [ReservasController::class, 'aprobar']);
Route::post('/reservaciones/{id}/cancelar', [ReservasController::class, 'cancelar']);
Route::post('/reservaciones/{id}/finalizar', [ReservasController::class, 'finalizar']);
Route::get('/reservaciones/misReservas/{user_id}', [ReservasController::class, 'misReservas']); 
require __DIR__.'/auth.php';
