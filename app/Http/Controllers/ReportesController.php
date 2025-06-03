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
public function ticket($idFunction)
{
    $ticket = DB::table('funciones')
        ->select(
            'funciones.Fecha',
            'funciones.HoraInicio as HoraInicio',
            'peliculas.NomPelicula as NomPelicula',
            'salas.IdSala as Sala',
            'peliculas.Clasificacion',
            DB::raw('GROUP_CONCAT(DISTINCT asientos_reservados.Fila) as Filas'),
            DB::raw('GROUP_CONCAT(DISTINCT asientos_reservados.NumeroAsiento) as NumeroAsiento'),
            DB::raw('SUM(reservaciones.Total) as Total')
        )
        ->join('salas_peliculas', 'funciones.IdSalasPeli', '=', 'salas_peliculas.IdSalasPeli')
        ->join('peliculas', 'salas_peliculas.IdPelicula', '=', 'peliculas.IdPelicula')
        ->join('salas', 'salas_peliculas.IdSala', '=', 'salas.IdSala')
        ->leftJoin('reservaciones', 'funciones.IdFuncion', '=', 'reservaciones.IdFuncion')
        ->leftJoin('asientos_reservados', 'reservaciones.Id', '=', 'asientos_reservados.Id')
        ->where('funciones.IdFuncion', $idFunction)
        ->groupBy(
            'funciones.IdFuncion',
            'funciones.Fecha',
            'funciones.HoraInicio',
            'peliculas.NomPelicula',
            'salas.IdSala', 
            'peliculas.Clasificacion'
        )
        ->first();

    if (!$ticket) {
        return response()->json(['error' => 'Función no encontrada'], 404);
    }

    return response()->json([
        'Fecha' => $ticket->Fecha,
        'HoraInicio' => $ticket->HoraInicio,
        'NomPelicula' => $ticket->NomPelicula,
        'Sala' => $ticket->Sala,
        'Clasificacion' => $ticket->Clasificacion,
        'Fila' => $ticket->Filas ?? 'N/A',
        'NumeroAsiento' => $ticket->NumeroAsiento ?? 'N/A',
        'Total' => $ticket->Total ?? 0
    ], 200);
}
}