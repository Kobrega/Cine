<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservacion;
use App\Models\AsientoReservado;
use App\Models\Funcion;
use App\Models\PreciosBoletos;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class ReservacionController extends Controller
{
   

    /**
     * Crea una nueva reservación
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'IdFuncion' => 'required|exists:funciones,IdFuncion',
            'asientos' => 'required|array|min:1',
            'asientos.*.Fila' => 'required|string|max:2',
            'asientos.*.NumeroAsiento' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'Error de validación',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            return DB::transaction(function () use ($request) {
                // Obtener información completa de la función
                $funcion = Funcion::with(['salas_peliculas.sala', 'salas_peliculas.pelicula'])
                    ->findOrFail($request->IdFuncion);

                // Validar disponibilidad de asientos
                $asientosOcupados = $this->verificarAsientosOcupados($request->IdFuncion, $request->asientos);
                
                if (!empty($asientosOcupados)) {
                    return response()->json([
                        'error' => 'Algunos asientos no están disponibles',
                        'asientos_ocupados' => $asientosOcupados
                    ], 409);
                }

                // Calcular el total basado en los precios
                $total = $this->calcularTotalReserva($funcion->salas_peliculas->sala->TipoSala, $request->asientos);

                // Crear la reservación
                $reservacion = Reservacion::create([
                    'IdFuncion' => $request->IdFuncion,
                    'FechaReserva' => now(),
                    'Estado' => 'confirmada',
                    'Total' => $total
                ]);

                // Reservar los asientos
                $this->reservarAsientos($reservacion->id, $funcion->salas_peliculas->IdSala, $request->IdFuncion, $request->asientos);

                return response()->json([
                    'success' => true,
                    'message' => 'Reserva creada exitosamente',
                    'data' => $reservacion->load(['asientos', 'funcion.salas_peliculas.pelicula', 'funcion.salas_peliculas.sala'])
                ], 201);

            });
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al procesar la reservación',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtiene los asientos reservados para una función
     */
    public function asientosReservados($idFuncion)
    {
        try {
            $asientos = AsientoReservado::where('IdFuncion', $idFuncion)
                ->select('Fila', 'NumeroAsiento')
                ->get();

            return response()->json([
                'success' => true,
                'funcion_id' => $idFuncion,
                'asientos_reservados' => $asientos
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al obtener asientos reservados',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtiene las reservaciones del usuario autenticado
     */
    public function misReservaciones()
    {
        try {
            $reservaciones = Reservacion::with([
                    'funcion.salas_peliculas.pelicula', 
                    'funcion.salas_peliculas.sala', 
                    'asientos',
                    'funcion' => function($query) {
                        $query->select('IdFuncion', 'IdSalasPeli', 'Fecha', 'HoraInicio');
                    }
                ])
                
                ->orderBy('FechaReserva', 'desc')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $reservaciones
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al obtener reservaciones',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    
    /**
     * Métodos auxiliares privados
     */

    private function verificarAsientosOcupados($idFuncion, $asientos)
    {
        $ocupados = [];
        
        foreach ($asientos as $asiento) {
            $existe = AsientoReservado::where([
                'IdFuncion' => $idFuncion,
                'Fila' => $asiento['Fila'],
                'NumeroAsiento' => $asiento['NumeroAsiento']
            ])->exists();

            if ($existe) {
                $ocupados[] = "{$asiento['Fila']}-{$asiento['NumeroAsiento']}";
            }
        }

        return $ocupados;
    }

    private function reservarAsientos($idReserva, $idSala, $idFuncion, $asientos)
    {
        $asientosReservados = [];
        
        foreach ($asientos as $asiento) {
            $asientosReservados[] = AsientoReservado::create([
                'IdReserva' => $idReserva,
                'IdSala' => $idSala,
                'IdFuncion' => $idFuncion,
                'Fila' => $asiento['Fila'],
                'NumeroAsiento' => $asiento['NumeroAsiento']
            ]);
        }

        return $asientosReservados;
    }

    private function calcularTotalReserva($tipoSala, $asientos)
    {
        // Obtener precios según tipo de sala
        $precios = PreciosBoletos::where('TipoSala', $tipoSala)
            ->pluck('Precio', 'Edad')
            ->toArray();

        $total = 0;
        
       
        foreach ($asientos as $asiento) {
            $total += $precios['Adulto'] ?? 100; 
        }

        return $total;
    }
}