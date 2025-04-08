<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cine;
use App\Models\Salas;
use App\Models\CinesSalas;

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
    //subir 
}

