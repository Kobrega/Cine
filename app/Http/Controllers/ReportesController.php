<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cine;
use App\Models\Salas;
use App\Models\Peliculas;
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

public function ticket($idFuncion)
{
    $ticket = Funcion::select([
            'funciones.Fecha',
            'funciones.HoraInicio',
            'peliculas.Nombre as NomPelicula',
            'salas.Nombre as Sala',
            'peliculas.Clasificacion',
            DB::raw('GROUP_CONCAT(DISTINCT asientos.Fila) as Filas'),
            DB::raw('GROUP_CONCAT(DISTINCT asientos.Numero) as NumerosAsientos'),
            DB::raw('SUM(reservas.Total) as Total')
        ])
        ->join('salas_peliculas', 'funciones.IdSalaPelicula', '=', 'salas_peliculas.IdSalaPelicula')
        ->join('peliculas', 'salas_peliculas.IdPelicula', '=', 'peliculas.IdPelicula')
        ->join('salas', 'salas_peliculas.IdSala', '=', 'salas.IdSala')
        ->leftJoin('reservas', 'funciones.IdFuncion', '=', 'reservas.IdFuncion')
        ->leftJoin('asientos_reservados', 'reservas.IdReserva', '=', 'asientos_reservados.IdReserva')
        ->leftJoin('asientos', 'asientos_reservados.IdAsiento', '=', 'asientos.IdAsiento')
        ->where('funciones.IdFuncion', $idFuncion)
        ->groupBy('funciones.IdFuncion')
        ->firstOrFail();

    return response()->json([
        'Fecha' => $ticket->Fecha,
        'Hora' => $ticket->HoraInicio,
        'NomPelicula' => $ticket->NomPelicula,
        'Sala' => $ticket->Sala,
        'Clasificacion' => $ticket->Clasificacion,
        'Fila' => $ticket->Filas,
        'NumeroAsiento' => $ticket->NumerosAsientos,
        'Total' => $ticket->Total
    ], 200);
}
}