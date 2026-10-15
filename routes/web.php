<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\SolicitudController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Página principal
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| Inicio de sesión
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])
        ->name('login');

    Route::post('/login', [LoginController::class, 'login'])
        ->name('login.authenticate');
});

/*
|--------------------------------------------------------------------------
| Solicitudes públicas
|--------------------------------------------------------------------------
| Permite registrar solicitudes sin iniciar sesión.
*/

Route::get('/solicitudes', [SolicitudController::class, 'create'])
    ->name('solicitudes.create');

Route::post('/solicitudes', [SolicitudController::class, 'store'])
    ->name('solicitudes.store');

/*
|--------------------------------------------------------------------------
| Rutas protegidas
|--------------------------------------------------------------------------
| Requieren una sesión autenticada.
*/

Route::middleware('auth')->group(function () {

    /*
    | Cierre de sesión
    */
    Route::post('/logout', [LoginController::class, 'logout'])
        ->name('logout');

    /*
    | CRUD de clientes
    */
    Route::resource('clientes', ClienteController::class)
        ->except(['show']);

    /*
    | Administración de solicitudes
    */
    Route::get('/admin/solicitudes', [SolicitudController::class, 'index'])
        ->name('admin.solicitudes');
});