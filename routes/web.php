<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RutaController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ReporteController;

Route::resource('rutas', RutaController::class);
Route::post('rutas/{id}/lugares', [RutaController::class, 'agregarLugar'])->name('rutas.lugares');
Route::delete('/lugares/{id}', [RutaController::class, 'eliminarLugar'])->name('lugares.destroy');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    //tour
    Route::resource('tours', TourController::class);
    Route::resource('categorias', CategoriaController::class); 

    //reportes
    Route::get('/reportes', [ReporteController::class, 'index'])->name('reportes.index');
    Route::get('/reportes/estadisticas', [ReporteController::class, 'estadisticas'])->name('reportes.estadisticas');
    Route::get('/reportes/pdf', [ReporteController::class, 'exportarPDF'])->name('reportes.pdf');  
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
