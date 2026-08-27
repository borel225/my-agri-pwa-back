<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCampagneRequest;
use App\Models\Campagne;
use Illuminate\Http\Request;

class CampagneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Campagne::orderBy('date_debut', 'desc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCampagneRequest $request)
    {
        //
        $campagne = Campagne::create(
            $request->validated()
        );

        return response()->json($campagne, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Campagne $campagne)
    {
        //
         return $campagne;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCampagneRequest $request, Campagne $campagne)
    {
        //
        $campagne->update(
            $request->validated()
        );

        return response()->json($campagne);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Campagne $campagne)
    {
        //
         $campagne->delete();

        return response()->json([
            'message' => 'Campagne supprimée avec succès.'
        ]);
    }
}
