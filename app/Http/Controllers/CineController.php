<?php

namespace App\Http\Controllers;

use App\Models\Cine;
use App\Http\Requests\StoreCineRequest;
use App\Http\Requests\UpdateCineRequest;

class CineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Cine::all(),200);
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
    public function store(StoreCineRequest $request)
    {
        return response()->json(Cine::create($request->all()),200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Cine $cine)
    {
        return response()->json($cine,200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cine $cine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCineRequest $request, Cine $cine)
    {
        return response()->json($cine->update($request->all()),200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cine $cine)
    {
        return response()->json($cine->DELETE(),200);
    }
}
