<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Middleware\IsAdmin; // Asegúrate de importar el middleware

// Ruta pública: Vista de documentos para los usuarios
Route::get('/', [DocumentController::class, 'listPublic'])->name('home');

// Rutas para descarga/ver documento
Route::get('/documento/{id}', [DocumentController::class, 'show'])->name('document.show');

// Rutas para el admin, protegidas por middleware "auth" y "is_admin"
Route::middleware(['auth', IsAdmin::class])->group(function () {
    Route::get('/dashboard', [DocumentController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/documento/crear', [DocumentController::class, 'create'])->name('document.create');
    Route::post('/dashboard/documento', [DocumentController::class, 'store'])->name('document.store');
    Route::get('/dashboard/documento/{id}/editar', [DocumentController::class, 'edit'])->name('document.edit');
    Route::put('/dashboard/documento/{id}', [DocumentController::class, 'update'])->name('document.update');
    Route::delete('/dashboard/documento/{id}', [DocumentController::class, 'destroy'])->name('document.destroy');

    // Rutas para gestionar categorías
    Route::get('/dashboard/categorias', [CategoryController::class, 'index'])->name('category.index');
    Route::post('/dashboard/categorias', [CategoryController::class, 'store'])->name('category.store');
    Route::delete('/dashboard/categorias/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
});

// Rutas de autenticación
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
        Route::post('/login', [AuthenticatedSessionController::class, 'store']);
    }); 

    