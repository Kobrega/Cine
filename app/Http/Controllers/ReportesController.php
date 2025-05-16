<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cine;
use App\Models\Salas;
use App\Models\CinesSalas;
use App\Models\SalasPelicula;
use App\Models\Funcion;

class ReportesController extends Controller
{
    public function ObtenerCineYSalas()
    {
        $result = CinesSalas::with(['cine', 'sala'])
            ->get()
            ->map(function ($item) {
                return [
                    'IdCineSala' => $item->IdCineSala,
                    'Cine' => $item->cine,
                    'Sala' => $item->sala
                ];
            });

        return response()->json($result, 200);
    }

    public function ObtenerSalaYPelicula()
    {
        $result = SalasPelicula::with(['pelicula', 'sala'])
            ->get()
            ->map(function ($item) {
                return [
                    'IdSalasPeli' => $item->IdSalasPeli,
                    'Pelicula' => $item->pelicula,
                    'Sala' => $item->sala
                ];
            });

        return response()->json($result, 200);
    }

    public function listaFunciones()
    {
        $funciones = Funcion::with(['salas_peliculas.pelicula', 'salas_peliculas.sala'])
            ->orderBy('Fecha')
            ->orderBy('HoraInicio')
            ->get();

        return response()->json($funciones, 200);
    }

    public function funcionesPorCine($idCine)
    {
        $funciones = Funcion::with(['salas_peliculas.pelicula', 'salas_peliculas.sala'])
            ->whereHas('salas_peliculas.sala.cines', function($query) use ($idCine) {
                $query->where('IdCine', $idCine);
            })
            ->orderBy('Fecha')
            ->orderBy('HoraInicio')
            ->get();

        return response()->json($funciones, 200);
    }
}