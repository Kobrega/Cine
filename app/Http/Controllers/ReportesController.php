<?php

namespace App\Http\Controllers;
use App\Models\CineController;

use Illuminate\Http\Request;
use App\Models\Cine;
use App\Models\Salas;
use App\Models\CinesSalas;

class ReportesController extends Controller
{
    public function ObtenerCineYSalas(){

        $result = CinesSalas::select('cines_salas.IdCineSala','a.IdCine as IdCine','b.IdSala as IdSala')
                            ->join('cines as a','Cines_Salas.IdCine','a.IdCine')
                            ->join('salas as b','Cines_Salas.IdSala','b.IdSala')
                            ->get();

        return Response()->json($result,200);
    }
}
