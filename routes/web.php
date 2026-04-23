<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RutaController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\CategoriaController;

Route::resource('rutas', RutaController::class);
Route::post('rutas/{id}/lugares', [RutaController::class, 'agregarLugar'])->name('rutas.lugares');
Route::delete('/lugares/{id}', [RutaController::class, 'eliminarLugar'])->name('lugares.destroy');
use App\Http\Controllers\ReservasController;
use App\Http\Controllers\ComentarioController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('tours', TourController::class);
    Route::resource('categorias', CategoriaController::class); 
    
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
// rutas para las reseñas
Route::post('/comentarios', [ComentarioController::class, 'store']);
Route::post('/comentarios/{id}', [ComentarioController::class, 'update']);
Route::post('/comentarios/{id}', [ComentarioController::class, 'destroy']);
Route::get('/comentarios/{tour_id}/{user_id}', [ComentarioController::class, 'comentariosPorUsuarioYTour']);
require __DIR__.'/auth.php';
