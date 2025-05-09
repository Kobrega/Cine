<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservacion;
use App\Models\AsientoReservado;
use Illuminate\Support\Facades\DB;


class ReservacionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
           'IdFuncion' => 'required|exists:funciones,IdFuncion',
            'asientos' => 'required|array|min:1',
            'asientos.*.Fila' => 'required|string',
            'asientos.*.NumeroAsiento' => 'required|integer',
        ]);

        return DB::transaction(function () use ($request) {
            // Validar que los asientos no estén ya reservados para esa función
            foreach ($request->asientos as $asiento) {
                $yaReservado = AsientoReservado::where([
                    ['IdFuncion', $request->IdFuncion],
                    ['Fila', $asiento['Fila']],
                    ['NumeroAsiento', $asiento['NumeroAsiento']],
                ])->exists();

                if ($yaReservado) {
                    return response()->json([
                        'mensaje' => "El asiento {$asiento['Fila']}-{$asiento['NumeroAsiento']} ya está reservado."
                    ], 422);
                }
            }

            // Crear la reservación
            $reservacion = Reservacion::create([
                'IdFuncion' => $request->IdFuncion
            ]);

            // Crear cada asiento reservado
            foreach ($request->asientos as $asiento) {
                AsientoReservado::create([
                    'IdReserva' => $reservacion->id,
                    'IdSala' => $request->IdSala ?? 1, // si no lo pasas, puedes asignar 1 o ajustarlo
                    'IdFuncion' => $request->IdFuncion,
                    'Fila' => $asiento['Fila'],
                    'NumeroAsiento' => $asiento['NumeroAsiento'],
                ]);
            }
            

            return response()->json([
                'mensaje' => 'Reserva realizada con éxito',
                'reserva_id' => $reservacion->id,
            ], 201);
        });
    }
    public function asientosReservados($idFuncion)
{
    $asientos = AsientoReservado::where('IdFuncion', $idFuncion)
        ->select('Fila', 'NumeroAsiento')
        ->get();

    return response()->json([
        'funcion_id' => $idFuncion,
        'asientos_reservados' => $asientos
    ]);
}
}
