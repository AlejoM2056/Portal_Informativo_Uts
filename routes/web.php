<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NoticiaController;

// Página principal
Route::get('/', [HomeController::class, 'index'])->name('home');

// Página de login
Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Panel de administración
Route::prefix('admin')->middleware('admin.auth')->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });

    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('admin.dashboard');

    Route::resource('noticias', NoticiaController::class)->names([
        'index' => 'admin.noticias',
        'create' => 'admin.noticias.crear',
        'store' => 'admin.noticias.store',
        'show' => 'admin.noticias.show',
        'edit' => 'admin.noticias.editar',
        'update' => 'admin.noticias.update',
        'destroy' => 'admin.noticias.destroy',
    ]);

    Route::post('noticias/{id}/destacar', [NoticiaController::class, 'toggleDestacar'])
    ->name('admin.noticias.destacar');

    Route::post('/admin/noticias/upload-imagen', [NoticiaController::class, 'uploadImagen'])
    ->name('admin.noticias.upload-imagen');
});
