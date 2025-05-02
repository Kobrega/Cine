<?php

namespace App\Http\Controllers;

use App\Models\PreciosXTipoSala;
use App\Models\Salas;
use App\Http\Requests\StorePreciosXTipoSalaRequest;
use App\Http\Requests\UpdatePreciosXTipoSalaRequest;

class PreciosXTipoSalaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(PreciosXTipoSala::all(),200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePreciosXTipoSalaRequest $request)
    {
        // Validación de la IdSala antes de agregar el registrop
        if (!Salas::where('IdSala', $request->IdSala)->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'La sala no existe'
            ], 404);
        }

        // Crear el registro si pasa la validación
        $valida = PreciosXTipoSala::create($request->all());
        
        return response()->json([
            'success' => true,
            'data' => $valida,
            'message' => 'Registro creado exitosamente'
        ], 201); // Código 201 para creación exitosa
    }
    
    /**
     * Display the specified resource.
     */
    public function show(PreciosXTipoSala $PrecioXTipoSala)
    {
        return response()->json($PrecioXTipoSala,200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PreciosXTipoSala $PrecioXTipoSala)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePreciosXTipoSalaRequest $request, PreciosXTipoSala $PrecioXTipoSala)
    {
        return response()->json($PrecioXTipoSala->update($request->all()),200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PreciosXTipoSala $PrecioXTipoSala)
    {
        return response()->json($PrecioXTipoSala->DELETE(),200);
    }
}
