<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RutaController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\CategoriaController;

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
    Route::resource('tours', TourController::class);
    Route::resource('categorias', CategoriaController::class); 
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
