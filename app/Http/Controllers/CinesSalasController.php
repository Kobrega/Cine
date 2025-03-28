<?php

namespace App\Http\Controllers;

use App\Models\CinesSalas;
use App\Http\Requests\StoreCinesSalasRequest;
use App\Http\Requests\UpdateCinesSalasRequest;

class CinesSalasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(CinesSalas::all(),200);
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
    public function store(StoreCinesSalasRequest $request)
    {
        return response()->json(CinesSalas::create($request->all()),200);
    }

    /**
     * Display the specified resource.
     */
    public function show(CinesSalas $cinesSala)
    {
        return response()->json($cinesSala,200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CinesSalas $cinesSala)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCinesSalasRequest $request, CinesSalas $cinesSala)
    {
        return response()->json($cinesSala->update($request->all()),200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CinesSalas $cinesSala)
    {
        return response()->json($cinesSala->DELETE(),200);
    }
}
