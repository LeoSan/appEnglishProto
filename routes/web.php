<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\ProfesorController;
use App\Http\Controllers\ClaseController;
use App\Http\Controllers\MultimediaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    //return view('index');
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Rutas para el alumno
    Route::resource('alumnos', AlumnoController::class)->middleware('role:admin,alumno');
    
    // Rutas para el profesor
    Route::resource('profesores', ProfesorController::class)->middleware('role:admin,profesor');
    
    // Rutas para las clases (sólo profesor por ahora)
    Route::resource('clases', ClaseController::class)->middleware('role:admin,profesor');
    
    // Rutas para multimedia (sólo profesor por ahora, él las crea y gestiona)
    Route::resource('multimedia', MultimediaController::class)->middleware('role:admin,profesor');
});

require __DIR__.'/auth.php';
