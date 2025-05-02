<?php

namespace App\Http\Controllers;

use App\Models\PrecioXHorario;
use App\Http\Requests\StorePrecioXHorarioRequest;
use App\Http\Requests\UpdatePrecioXHorarioRequest;

class PrecioXHorarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(PrecioXHorario::all(),200);
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
    public function store(StorePrecioXHorarioRequest $request)
    {
        return response()->json(PrecioXHorario::create($request->all()),200);
    }

    /**
     * Display the specified resource.
     */
    public function show(PrecioXHorario $PrecioXHorario )
    {
        return response()->json($PrecioXHorario ,200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PrecioXHorario $PrecioXHorario )
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePrecioXHorarioRequest $request, PrecioXHorario $PrecioXHorario )
    {
        return response()->json($PrecioXHorario ->update($request->all()),200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PrecioXHorario $PrecioXHorario )
    {
        return response()->json($PrecioXHorario ->DELETE(),200);
    }
}
