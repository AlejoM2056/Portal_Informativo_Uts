<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NoticiaController;

// Página principal
Route::get('/', [HomeController::class, 'index'])->name('home');

// Página de login (solo visual)
Route::get('/login', [HomeController::class, 'login'])->name('login');

// Panel de administración
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('admin.dashboard');
    
    // Rutas del CRUD de noticias
    Route::resource('noticias', NoticiaController::class)->names([
        'index' => 'admin.noticias',
        'create' => 'admin.noticias.crear',
        'store' => 'admin.noticias.store',
        'show' => 'admin.noticias.show',
        'edit' => 'admin.noticias.editar',
        'update' => 'admin.noticias.update',
        'destroy' => 'admin.noticias.destroy',
    ]);
});