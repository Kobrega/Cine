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

        $result = CinesSalas::select('IdCineSala','IdCine','IdSala')
                            ->join('cines as a','CinesSalas.IdCine','a.IdCine')
                            ->join('salas as b','CinesSalas.IdSala','b.IdSala')
                            ->get();

        return Response()->json($result,200);
    }
}
