<?php

namespace App\Http\Controllers;
use App\Models\CineController;

use Illuminate\Http\Request;
use App\Models\Cine;
use App\Models\Salas;
use App\Models\CinesSalas;
use App\Models\SalasPelicula;
use App\Models\Funcion;

class ReportesController extends Controller
{
    public function ObtenerCineYSalas(){

        $result = CinesSalas::select('cines_salas.IdCineSala','a.IdCine as IdCine','b.IdSala as IdSala')
                            ->join('cines as a','Cines_Salas.IdCine','a.IdCine')
                            ->join('salas as b','Cines_Salas.IdSala','b.IdSala')
                            ->get();

        return Response()->json($result,200);
    }

    public function ObtenerSalaYPelicula(){
        $result = SalasPelicula::select('salas_peliculas.IdSalasPeli','a.IdPelicula as IdPelicula','b.IdSala as IdSala')
                                ->join('peliculas as a', 'Salas_Peliculas.IdPelicula','a.IdPelicula')
                                ->join('salas as b','Salas_Peliculas.IdSala','b.IdSala')
                                ->get();
        return Response()->json($result,200);
    }

    // Listar funciones
    public function listaFunciones()
    {
        $funciones = Funcion::with('salas_peliculas.pelicula', 'salas_peliculas.sala')->get();
        return view('reportes.funciones', compact('funciones'));
    }
}
