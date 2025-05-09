<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AsientoReservado;

class AsientosReservadosController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'IdFuncion' => 'required|exists:funciones,IdFuncion',
            'IdSala' => 'required',
            'asientos' => 'required|array|min:1',
            'asientos.*.Fila' => 'required|string',
            'asientos.*.NumeroAsiento' => 'required|integer',
        ]);

        $reservados = [];

        foreach ($request->asientos as $asiento) {
            // Verificamos si ya está reservado
            $existe = AsientoReservado::where('IdFuncion', $request->IdFuncion)
                ->where('Fila', $asiento['Fila'])
                ->where('NumeroAsiento', $asiento['NumeroAsiento'])
                ->exists();

            if ($existe) {
                return response()->json([
                    'error' => 'El asiento Fila ' . $asiento['Fila'] . ' Número ' . $asiento['NumeroAsiento'] . ' ya está reservado.'
                ], 409);
            }

            // Si no existe, lo reservamos
            $reservados[] = AsientoReservado::create([
                'IdFuncion' => $request->IdFuncion,
                'IdSala' => $request->IdSala,
                'Fila' => $asiento['Fila'],
                'NumeroAsiento' => $asiento['NumeroAsiento'],
            ]);
        }

        return response()->json([
            'message' => 'Asientos reservados exitosamente.',
            'reservas' => $reservados
        ], 201);
    }
}
