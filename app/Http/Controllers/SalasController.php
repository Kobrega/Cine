<?php

namespace App\Http\Controllers;

use App\Models\Salas;
use App\Http\Requests\StoreSalasRequest;
use App\Http\Requests\UpdateSalasRequest;

class SalasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Salas::all(),200);
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
    public function store(StoreSalasRequest $request)
    {
        return response()->json(Salas::create($request->all()),200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Salas $sala)
    {
        return response()->json($sala,200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Salas $sala)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSalasRequest $request, Salas $sala)
    {
        return response()->json($sala->update($request->all()),200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Salas $sala)
    {
        return response()->json($sala->DELETE(),200);
    }
}
