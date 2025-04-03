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
    //subir 
}

