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

        

        DB::table('reservaciones')->insert([
            'IdFuncion' => $IdFuncion,
            'asiento' => $asiento,
            'reservado' => true,
        ]);

         if ($existe) {
            return response()->json(['mensaje' => 'El asiento ya está reservado'], 409);
        }
        return response()->json([
            'mensaje' => 'Asiento reservado con éxito',
        ]);
    }

    public function index()
    {
        return response()->json(Reservacion::all());
    }

}
