<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cine;
use App\Models\Salas;
use App\Models\CinesSalas;

class procesosController extends Controller
{
    public function insertarSalaEnCine(Request $request){

        // ------  pregunto si el id que del Cine que quiero guardar exista en la tabla --------- //
        $existeCine = Cine::where('IdCine',$request->IdCine)->exist();

            // ------ si la variable $exiteCine no trae valor regresar mensaje al usuario ----- //
            if(!$existeCine){
                return Response()->json(["Error"=>true,"Mensaje"=>"El Id de cine no existe :c"],422);
            }
        
        // ------------------------------------------------------------------------------------------------- //
        $existeSala = Salas::where('IdSala',$request->IdSala)->exist();

        if(!$existeSala){
            return Response()->json(["Error"=>true,"Mensaje"=>"El Id de Sala no existe :c"],422);
        }

        $existeRegistro = CinesSalas::where('IdCine', $request-> IdCine)
                                        ->where('IdSala', $request->IdSala)
                                        ->exist();
        if(!$existeRegistro){
            return Response()->json(["Error"=>true,"Mensaje"=>"No existe este registro :c"],422);
        }

        $result = CinesSalas :: create([
            "IdCine", $request->IdCine,
            "IdSala", $request->IdSala
        ]);

        return Response ()-> json(["Error"=>true,"Mensaje"=>"El Id de Cine no existe :c"]);
    }
}
