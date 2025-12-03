<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController; // NUEVO: Controlador de Autenticación

// Importación de todos los controladores creados (los de CRUD)
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ElementoController;
use App\Http\Controllers\ElementoReferenciaController;
use App\Http\Controllers\ParcelaController;
use App\Http\Controllers\RevisionParcelaController;
use App\Http\Controllers\ParcelaElementoController;
use App\Http\Controllers\AnalisisElementoController;
use App\Http\Controllers\RecomendacionAplicacionController;


/*
|--------------------------------------------------------------------------
| Rutas de Autenticación (Públicas)
|--------------------------------------------------------------------------
*/

// Muestra el formulario de login. Usamos ->name('login') para que el middleware sepa dónde redirigir.
Route::get('login', [AuthController::class, 'loginForm'])->name('login');
// Procesa el intento de login
Route::post('login', [AuthController::class, 'login']);
// Cierra la sesión
Route::post('logout', [AuthController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| Rutas Protegidas (Requieren autenticación)
|--------------------------------------------------------------------------
*/

// Todas las rutas dentro de este grupo requieren que el usuario esté logeado
Route::middleware('auth')->group(function () {

    // Ruta de inicio (Dashboard)
    Route::get('/', function () {
        return view('inicio');
    })->name('inicio');


    // Rutas de Recursos (CRUD)
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('elementos', ElementoController::class);
    Route::resource('referencias', ElementoReferenciaController::class)->parameters(['referencias' => 'elementoReferencia']);
    Route::resource('parcelas', ParcelaController::class);
    Route::resource('revisiones', RevisionParcelaController::class);
    Route::resource('muestreos', ParcelaElementoController::class);

    // Rutas de Resultados (Solo Index)
    Route::resource('analisis', AnalisisElementoController::class)->only(['index']);
    Route::resource('recomendaciones', RecomendacionAplicacionController::class)->only(['index']);

});
