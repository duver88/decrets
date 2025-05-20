<?php

use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConceptController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ConceptTypeController;
use App\Http\Controllers\ConceptThemeController;
use App\Http\Controllers\ConceptPermissionController;
use App\Http\Controllers\UserCategoryPermissionController;  
use App\Http\Controllers\Auth\AuthenticatedSessionController;


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

// Rutas para gestionar permisos de usuarios (solo admin)  
Route::middleware(['auth', IsAdmin::class])->group(function () {  
    Route::get('/dashboard/permisos', [UserCategoryPermissionController::class, 'index'])  
         ->name('permissions.index');  
    Route::post('/dashboard/permisos', [UserCategoryPermissionController::class, 'store'])  
         ->name('permissions.store');  
    Route::delete('/dashboard/permisos/{id}', [UserCategoryPermissionController::class, 'destroy'])  
         ->name('permissions.destroy');  
});  
  
// Rutas para usuarios normales  
Route::middleware(['auth'])->group(function () {  
    Route::get('/users/dashboard', [DocumentController::class, 'index'])  
         ->name('user.dashboard');  
    Route::get('/users/dashboard/documento/crear', [DocumentController::class, 'create'])  
         ->name('user.document.create');  
    Route::post('/users/dashboard/documento', [DocumentController::class, 'store'])  
         ->name('user.document.store');  
    Route::get('/users/dashboard/documento/{id}/editar', [DocumentController::class, 'edit'])  
         ->name('user.document.edit');  
    Route::put('/users/dashboard/documento/{id}', [DocumentController::class, 'update'])  
         ->name('user.document.update');  
    Route::delete('/users/dashboard/documento/{id}', [DocumentController::class, 'destroy'])  
         ->name('user.document.destroy');  
});

// Rutas para conceptos
Route::middleware(['auth'])->prefix('concepts')->name('concepts.')->group(function () {
    // Rutas principales (sin parámetros)
    Route::get('/', [ConceptController::class, 'index'])->name('index');
    Route::get('/create', [ConceptController::class, 'create'])->name('create');
    Route::post('/', [ConceptController::class, 'store'])->name('store');
    
    
    // Rutas específicas que no deben ser confundidas con IDs (IMPORTANTE: estas rutas deben ir ANTES de las rutas con parámetros)
    Route::get('/themes/{typeId}', [ConceptController::class, 'getThemes'])->name('getThemes');
    
    // Rutas para categorías y permisos (solo administradores)
    Route::middleware([IsAdmin::class])->group(function () {
        Route::get('/categories', [ConceptTypeController::class, 'index'])->name('categories');
        Route::post('/categories/types', [ConceptTypeController::class, 'store'])->name('storeType');
        Route::post('/categories/themes', [ConceptThemeController::class, 'store'])->name('storeTheme');
        Route::delete('/categories/types/{id}', [ConceptTypeController::class, 'destroy'])->name('destroyType');
        Route::delete('/categories/themes/{id}', [ConceptThemeController::class, 'destroy'])->name('destroyTheme');
        
        Route::get('/permissions', [ConceptPermissionController::class, 'index'])->name('permissions');
        Route::post('/permissions', [ConceptPermissionController::class, 'update'])->name('updatePermissions');
    });
    
    // Rutas con parámetros (DEBEN IR AL FINAL)
    Route::get('/{id}', [ConceptController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [ConceptController::class, 'edit'])->name('edit');
    Route::put('/{id}', [ConceptController::class, 'update'])->name('update');
    Route::delete('/{id}', [ConceptController::class, 'destroy'])->name('destroy');
});

// Ruta auxiliar para obtener temas (alternativa sin prefijo para depuración)
Route::get('/get-themes/{typeId}', [ConceptController::class, 'getThemes'])->name('direct.getThemes');