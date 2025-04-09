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

Route::post('/insertar-sala-en-cine', [procesosController::class, 'insertarSalaEnCine']);

Route::get('/obtener-salas-asignadas',[ReportesController::class, 'ObtenerCineYSalas'])->name('ObtenerCineYSalas');

Route::put('/actualizar-sala-en-cine/{id}', [procesosController::class, 'actualizarSalaEnCine']);

Route::resource('/pelicula', PeliculasController::class);

Route::resource('/sala', SalasController::class);

Route::resource('/cine', CineController::class);

Route::post('/login',[LoginController::class,'authenticate'])->name('Login');

Route::post('logout',[LoginController::class,'logout'])->name('logout');

Route::DELETE('/Eliminar-cine-sala/{id}',[ProcesosController::class,'Eliminarcinesala']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
