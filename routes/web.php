<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Seguridad\LoginController;
use App\Http\Controllers\Seguridad\UsuarioController;
use App\Http\Controllers\PasswordRecoveryController;

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

        Route::post('/usuarios/{id}/foto', [UsuarioController::class, 'subirFoto'])->name('usuarios.foto');
        Route::get('/usuarios/{id}/foto', [UsuarioController::class, 'formularioFoto'])->name('usuarios.formulario_foto');
    });
    
    /**USUARIO */
    Route::prefix('usuario')->group(function () {
        Route::get('/catalogo', [
            UsuarioController::class,
            'catalogo'
        ])->name('usuarios.catalogo');
    });

    Route::get('/recuperar-contrasena', [PasswordRecoveryController::class, 'formCorreo'])->name('password.formCorreo');
    Route::post('/recuperar-contrasena', [PasswordRecoveryController::class, 'enviarCodigo'])->name('password.enviarCodigo');

    Route::get('/validar-codigo', [PasswordRecoveryController::class, 'formCodigo'])->name('password.formCodigo');
    Route::post('/validar-codigo', [PasswordRecoveryController::class, 'validarCodigo'])->name('password.validarCodigo');

    Route::get('/nueva-contrasena', [PasswordRecoveryController::class, 'formNueva'])->name('password.formNueva');
    Route::post('/nueva-contrasena', [PasswordRecoveryController::class, 'guardarNueva'])->name('password.guardarNueva');
});
