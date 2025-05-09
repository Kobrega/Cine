<?php

namespace App\Http\Controllers;

use App\Models\PreciosBoletos;
use App\Http\Requests\StorePreciosBoletosRequest;
use App\Http\Requests\UpdatePreciosBoletosRequest;

class PreciosBoletosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(PreciosBoletos::all(),200);
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
    public function store(StorePreciosBoletosRequest $request)
    {
        return response()->json(PreciosBoletos::create($request->all()),200);
    }

    /**
     * Display the specified resource.
     */
    public function show(PreciosBoletos $precios_boleto)
    {
        return response()->json($precios_boleto,200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PreciosBoletos $precios_boleto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePreciosBoletosRequest $request, PreciosBoletos $precios_boleto)
    {
        return response()->json($precios_boleto->update($request->all()),200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PreciosBoletos $precios_boleto)
    {
        return response()->json($precios_boleto->DELETE(),200);
    }
}
