<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cine;
use App\Models\Salas;
use App\Models\CinesSalas;
use App\Models\Peliculas;
use App\Models\SalasPelicula;
use App\Models\Funcion;
class procesosController extends Controller
{
    public function insertarSalaEnCine(Request $request){

       // ------  Pregunto si el Id del Cine que quiero guardar existe en la tabla --------- //
        $existeCine = Cine::where('IdCine', $request->IdCine)->exists();

        // ------ Si la variable $existeCine no trae valor, regresar mensaje al usuario ----- //
        if (!$existeCine) {
            return response()->json(["Error" => true, "Mensaje" => "El Id de cine no existe :c"], 422);
        }

        // ------------------------------------------------------------------------------------------------- //
        $existeSala = Salas::where('IdSala', $request->IdSala)->exists();

        if (!$existeSala) {
            return response()->json(["Error" => true, "Mensaje" => "El Id de Sala no existe :c"], 422);
        }

        $existeRegistro = CinesSalas::where('IdCine', $request->IdCine)
                                    ->where('IdSala', $request->IdSala)
                                    ->exists();

        if ($existeRegistro) {
            return response()->json(["Error" => true, "Mensaje" => "Este registro ya existe :c"], 422);
        }

        // Crear el nuevo registro
        $result = CinesSalas::create([
            "IdCine" => $request->IdCine,
            "IdSala" => $request->IdSala
        ]);

        return response()->json(["Error" => false, "Mensaje" => "Registro insertado correctamente"]);
    }

    public function actualizarSalaEnCine(Request $request, $id)
{
    try {
        // Validar que el cine exista
        $existeCine = Cine::where('IdCine', $request->IdCine)->exists();
        if (!$existeCine) {
            return response()->json(["Error" => true, "Mensaje" => "El Id de cine no existe :c"], 422);
        }

        // Validar que la sala exista
        $existeSala = Salas::where('IdSala', $request->IdSala)->exists();
        if (!$existeSala) {
            return response()->json(["Error" => true, "Mensaje" => "El Id de Sala no existe :c"], 422);
        }

        // Buscar el registro a actualizar
        $registro = CinesSalas::find($id);
        if (!$registro) {
            return response()->json(["Error" => true, "Mensaje" => "El registro no fue encontrado :c"], 404);
        }

        // Verificar que no exista otro registro con el mismo IdCine e IdSala (excepto el que estamos actualizando)
        $existeRegistro = CinesSalas::where('IdCine', $request->IdCine)
                                     ->where('IdSala', $request->IdSala)
                                     ->where('IdCineSala', '!=', $id)
                                     ->exists();
        if ($existeRegistro) {
            return response()->json(["Error" => true, "Mensaje" => "Ya existe un registro con este IdCine e IdSala :c"], 422);
        }

        // Actualizar el registro
        $registro->IdCine = $request->IdCine;
        $registro->IdSala = $request->IdSala;
        $registro->save();

        return response()->json(["Error" => false, "Mensaje" => "Registro actualizado correctamente"]);

    } catch (\Exception $e) {
        // Captura cualquier error y retorna el mensaje de error
        return response()->json(["Error" => true, "Mensaje" => "Ocurrió un error: " . $e->getMessage()], 500);
    }
}


    public function EliminarCineEnSala(CinesSalas $Eliminarcinesala, $id)
    {
        $Eliminarcinesala=CinesSalas::findOrFail($id);//manda 404 Found si no existe 
        $Eliminarcinesala->delete();

        return response()->json([
            'success'=> true,
            'mensage'=>'Registro Cine_Salas Elinimado Correctamente'
        ],200);
    }//Delete

    public function InsertarPeliculaEnSala(Request $request){
        // ------  Pregunto si el Id de la pelicula que quiero guardar existe en la tabla --------- //
        $existePelicula = Peliculas::where('IdPelicula', $request->IdPelicula)->exists();

        // ------ Si la variable $existePelicula no trae valor, regresar mensaje al usuario ----- //
        if (!$existePelicula) {
            return response()->json(["Error" => true, "Mensaje" => "El Id de pelicula no existe :c"], 422);
        }

        // ---------------------------hacer la verificacion de la id de la sala------------------------- //
        $existeSala = Salas::where('IdSala', $request->IdSala)->exists();
        // ------ Si la variable $existeSala no trae valor, regresar mensaje al usuario ----- //
        if (!$existeSala) {
            return response()->json(["Error" => true, "Mensaje" => "El Id de Sala no existe :c"], 422);
        }

        // Verificar que no exista otro registro con el mismo IdCine e IdSala (excepto el que estamos actualizando)
        $existeRegistro = SalasPelicula::where('IdPelicula', $request->IdPelicula)
                                        ->where('IdSala', $request->IdSala)
                                        ->exists();

        if ($existeRegistro) {
        return response()->json(["Error" => true, "Mensaje" => "Ya existe un registro con este IdCine e IdSala :c"], 422);
        }

        // Crear el nuevo registro
        $result = SalasPelicula::create([
            "IdPelicula" => $request->IdPelicula,
            "IdSala" => $request->IdSala
        ]);
        
        return response()->json(["Error" => false, "Mensaje" => "Registro insertado correctamente"]);
    }

    public function ActualizarPeliculaEnSala(Request $request, $id){
        try{

        // Validar que la pelicula exista
        $existePelicula = Peliculas::where('IdPelicula', $request->IdPelicula)->exists();
        if (!$existePelicula) {
            return response()->json(["Error" => true, "Mensaje" => "El Id de pelicula no existe :c"], 422);
        }
        
        // Validar que la sala exista
        $existeSala = Salas::where('IdSala', $request->IdSala)->exists();
        if (!$existeSala) {
            return response()->json(["Error" => true, "Mensaje" => "El Id de Sala no existe :c"], 422);
        }

        // Buscar el registro a actualizar
        $registro = SalasPelicula::find($id);
        if (!$registro) {
            return response()->json(["Error" => true, "Mensaje" => "El registro no fue encontrado :c"], 404);
        }
        
         // Verificar que no exista otro registro con el mismo IdCine e IdSala (excepto el que estamos actualizando)
        $existeRegistro = SalasPelicula::where('IdPelicula', $request->IdPelicula)
                                     ->where('IdSala', $request->IdSala)
                                     ->where('IdSalasPeli', '!=', $id)
                                     ->exists();
        if ($existeRegistro) {
            return response()->json(["Error" => true, "Mensaje" => "Ya existe un registro con este IdPelicula e IdSala :c"], 422);
        }

        // Actualizar el registro
        $registro->IdPelicula = $request->IdPelicula;
        $registro->IdSala = $request->IdSala;
        $registro->save();
        
        return response()->json(["Error" => false, "Mensaje" => "Registro actualizado correctamente"]);
        
        } catch (\Exception $e) {
            // Captura cualquier error y retorna el mensaje de error
            return response()->json(["Error" => true, "Mensaje" => "Ocurrió un error: " . $e->getMessage()], 500);
        }
    }

    public function EliminarPeliculaDeSala(SalasPelicula $EliminarPeliculaSala, $id){
        $EliminarPeliculaSala=SalasPelicula::findOrFail($id);//manda 404 Found si no existe 
        $EliminarPeliculaSala->delete();

        return response()->json(['success'=> true,'mensage'=>'Registro Elinimado Correctamente'],200);
    }

 
    
 
 
     // Actualizar función
     public function guardarFuncion(Request $request)
    {
         $request->validate([
             'IdSalasPeli' => 'required|exists:salas_peliculas,IdSalasPeli',
             'Fecha' => 'required|date',
             'HoraInicio' => 'required',
             'HoraFin' => 'required',
         ]);
     
         // Crear la función
         $funcion = Funcion::create($request->all());
     
         return response()->json(['message' => 'Función creada correctamente.','data' => $funcion], 201); // 201 Created
    }
 
     // Eliminar función
     public function eliminarFuncion($id)
    {
        // Buscar la función por su ID
        $funcion = Funcion::findOrFail($id);

        // Eliminar la función
        $funcion->delete();

   
        return response()->json(['message' => 'Función eliminada correctamente.','data' => $funcion
        ], 200); // 200 OK
    }
    //put de la tabla de funciones
    public function actualizarFuncion(Request $request, $id)
    {
        $request->validate([
            'IdSalasPeli' => 'required|exists:salas_peliculas,IdSalasPeli',
            'Fecha' => 'required|date',
            'HoraInicio' => 'required',
            'HoraFin' => 'required',
        ]);
    
        // Buscar la función existente
        $funcion = Funcion::find($id);
    
        if (!$funcion) {
            return response()->json(['message' => 'Función no encontrada.'], 404);
        }
    
        // Actualizar la función con los datos del request
        $funcion->update($request->all());
    
        return response()->json(['message' => 'Función actualizada correctamente.', 'data' => $funcion], 200); // 200 OK
    }

}

