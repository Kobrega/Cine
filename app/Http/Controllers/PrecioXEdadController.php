<?php

namespace App\Http\Controllers;

use App\Models\PrecioXEdad;
use App\Http\Requests\StorePrecioXEdadRequest;
use App\Http\Requests\UpdatePrecioXEdadRequest;

class PrecioXEdadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(PrecioXEdad::all(),200);
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
    public function store(StorePrecioXEdadRequest $request)
    {
        return response()->json(PrecioXEdad::create($request->all()),200);
    }

    /**
     * Display the specified resource.
     */
    public function show(PrecioXEdad $PrecioXEdad)
    {
        return response()->json($PrecioXEdad,200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PrecioXEdad $PrecioXEdad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePrecioXEdadRequest $request, PrecioXEdad $PrecioXEdad)
    {
        return response()->json($PrecioXEdad->update($request->all()),200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PrecioXEdad $PrecioXEdad)
    {
        return response()->json($PrecioXEdad->DELETE(),200);
    }
}
