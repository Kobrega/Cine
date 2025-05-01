
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>


# Sobre Nuestra API 
Nuestra API está enfocada para franquicias de cine, lo que hace es administrar las salas de cine, asi como crear las funciones y organizar los horarios de las películas vigentes por semana del cine, también contiene la venta de boletos para el área de taquilla o de dulcería, este es un proyecto de universidad el cual está siendo elaborado por un equipo de 5 y cada semana se está actualizando y mejorando hasta llegar a la versión final.



# Tablas
En este apartado se encuentran las tablas que llevamos hasta el momento y se actualizarán con el tiempo.

## Tabla Cines
Esta tabla es la tabla principal porque es donde se registran los cines y su estructura es:

|IdCine|id|
| ------------ | ------------ |
|NomCine|varchar(50)|
|Direccion|varchar(60)|
|HorarioA|time|
|HorarioC|time|
|created_at|timestamp|
|updated_at|timestamp|

## Tabla Salas
Esta tabla es donde se van a registrar las salas de cada cine relacionandose con las ID y su estructura es:

|IdSalas|id |
| ------------ | ------------ |
|TipoProyector|varchar(30)|
|CantidadAsientos|smallint|
|TipoSala|varchar(20)|
|created_at|timestamp|
|updated_at|timestamp|

## Tabla Peliculas
Esta es la tercera tabla de nuestro proyecto y aqui se guardaran las peliculas que se reproduciran en las salas, esta estara conectada con la tabla de salas y su estructura es:

|IdPelicula|id|
| ------------ | ------------ |
|NomPelicula|varchar(40)|
|Duracion|time|
|Clasficacion|varchar(10)|
|created_at|timestamp|
|updated_at|timestamp|

## Tabla Cines_Salas
Esta tabla es la que relacion entre la tabla cines y la tabla salas donde estan guardadas sus ID para tener la relacion de que cines tienen que salas y su estructura es:

|IdCineSala|id|
| ------------ | ------------ |
|IdPelicula|foreignId|
|IdSala|foreignId|
|created_at|timestamp|
|updated_at|timestamp|

## Tabla Salas_Peliculas
Esta tabla es la que relacion entre la tabla salas y la tabla de peliculas ara relacionar y agregar una pelicula a una sala y su estructura es:

|IdSalasPeli|id|
| ------------ | ------------ |
|IdCine|foreignId|
|IdSala|foreignId|
|created_at|timestamp|
|updated_at|timestamp|


# Lineas de codigo
### Nuestras rutas


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
    //prueba
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

    //RUTAS DE LA TABLA FUNCIONES--------------------
    Route::post('/funciones/guardar', [ProcesosController::class, 'guardarFuncion']);
    Route::get('/funciones', [ReportesController::class, 'listaFunciones']);
    Route::delete('/funciones/{id}/eliminar', [ProcesosController::class, 'eliminarFuncion']);
    Route::put('/funciones/{id}/actualizar', [ProcesosController::class, 'actualizarFuncion']);
    //-------------------------------------------------

    Route::resource('/pelicula', PeliculasController::class);

    Route::resource('/sala', SalasController::class);

    Route::resource('/cine', CineController::class);

    Route::post('/login',[LoginController::class,'authenticate'])->name('Login');

    Route::post('logout',[LoginController::class,'logout'])->name('logout');

    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');

    ?>

### Equipo 1
- Aceves Sanchez Luis Rafael
- Alarcon Quezada Angel Leonardo
- Cu Lopez Kobe Gael
- Lopez Chaides Alexis Enrique
- Quintana Villareal Jose Alfredo
