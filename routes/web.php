<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Seguridad\LoginController;
use App\Http\Controllers\Seguridad\UsuarioController;

Route::get('/', function () {
    return redirect('/seguridad/auth/login');
});

/**SEGURIDAD */
Route::prefix('seguridad')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::get('/login', [LoginController::class, 'login'])->name('login');

        Route::post('/acceso', [
            LoginController::class,
            'acceso'
        ])->name('login.acceso');
    });
    
    /**USUARIO */
    Route::prefix('usuario')->group(function () {
        Route::get('/catalogo', [
            UsuarioController::class,
            'catalogo'
        ])->name('usuarios.catalogo');
    });
});
