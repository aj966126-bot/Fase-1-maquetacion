
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;

// Mostrar la página principal.
Route::get('/', function () {
    return view('welcome');
});

// Mostrar formulario para editar un cliente
Route::get('/clientes/{id}/editar', [ClienteController::class, 'edit'])
    ->name('clientes.edit');

// Guardar los cambios de un cliente
Route::put('/clientes/{id}', [ClienteController::class, 'update'])
    ->name('clientes.update');

// Eliminar un cliente
Route::delete('/clientes/{id}', [ClienteController::class, 'destroy'])
    ->name('clientes.destroy');

// Mostrar la lista de clientes registrados.
Route::get('/clientes', [ClienteController::class, 'index'])
    ->name('clientes.index');