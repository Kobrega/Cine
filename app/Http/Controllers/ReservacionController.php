<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservacion;
use Illuminate\Support\Facades\DB;

class ReservacionController extends Controller
{
    public function reservar(Request $request)
    {
        $request->validate([
            'IdFuncion' => 'required|integer',
            'asiento' => 'required|string',
        ]);

        $IdFuncion = $request->input('IdFuncion');
        $asiento = $request->input('asiento');

        $existe = DB::table('reservaciones')
            ->where('IdFuncion', $IdFuncion)
            ->where('asiento', $asiento)
            ->exists();

        if ($existe) {
            return response()->json(['mensaje' => 'El asiento ya está reservado'], 409);
        }

       $total = 80.00; 

        DB::table('reservaciones')->insert([
            'IdFuncion' => $IdFuncion,
            'asiento' => $asiento,
            'FechaReserva' => now(),
            'Total' => $total,
        ]);

        return response()->json([
            'mensaje' => 'Asiento reservado con éxito',
        ]);
    }

    public function index()
    {
        return response()->json(Reservacion::all());
    }
}
