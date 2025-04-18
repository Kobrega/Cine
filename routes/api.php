<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CineController;
use App\Http\Controllers\SalasController;
use App\Http\Controllers\PeliculasController;
use App\Http\Controllers\CinesSalasController;
use App\Http\Controllers\ProcesosController;
use App\Http\Controllers\ReportesController;

Route::get('/hola', function (Request $request) {
    return "HOLA MUNDO";
});
//RUTAS DE LA TABLA SALAS_PELICULAS
Route::post('/insertar-pelicula-en-sala', [procesosController::class, 'InsertarPeliculaEnSala']);

Route::get('/obtener-pelicula-en-sala',[ReportesController::class, 'ObtenerSalaYPelicula'])->name('ObtenerSalaYPelicula');

Route::put('/actualizar-pelicula-en-sala/{id}',[procesosController::class,'ActualizarPeliculaEnSala']);

Route::delete('/eliminar-pelicula-de-sala/{id}',[procesosController::class,'EliminarPeliculaDeSala']);
//------------------------------

//RUTAS DE LA TABLA CINE_SALAS
Route::post('/insertar-sala-en-cine', [procesosController::class, 'insertarSalaEnCine']);

Route::get('/obtener-salas-asignadas',[ReportesController::class, 'ObtenerCineYSalas'])->name('ObtenerCineYSalas');

Route::put('/actualizar-sala-en-cine/{id}', [procesosController::class, 'actualizarSalaEnCine']);

Route::delete('/Eliminar-cine-sala/{id}',[ProcesosController::class,'EliminarCineEnSala']);
//-----------------------------------------------------
Route::resource('/pelicula', PeliculasController::class);

Route::resource('/sala', SalasController::class);

Route::resource('/cine', CineController::class);

Route::post('/login',[LoginController::class,'authenticate'])->name('Login');

Route::post('logout',[LoginController::class,'logout'])->name('logout');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
