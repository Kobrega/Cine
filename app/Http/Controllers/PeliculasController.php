<?php

namespace App\Http\Controllers;

use App\Models\Peliculas;
use App\Http\Requests\StorePeliculasRequest;
use App\Http\Requests\UpdatePeliculasRequest;

class PeliculasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Peliculas::all(),200);
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
    public function store(StorePeliculasRequest $request)
    {
        return response()->json(Peliculas::create($request->all()),200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Peliculas $pelicula)
    {
        return response()->json($pelicula,200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Peliculas $pelicula)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePeliculasRequest $request, Peliculas $pelicula)
    {
        return response()->json($pelicula->update($request->all()),200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Peliculas $pelicula)
    {
        return response()->json($pelicula->DELETE(),200);
    }
}
