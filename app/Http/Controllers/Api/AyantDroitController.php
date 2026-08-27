<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAyantDroitRequest;
use App\Models\AyantDroit;
use Illuminate\Http\Request;

class AyantDroitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
         return AyantDroit::with([
            'producteur',
            'parcelles'
        ])
        ->orderBy('id','desc')
        ->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAyantDroitRequest $request)
    {
        //
            $ayantDroit = AyantDroit::create(
            $request->validated());

            return response()->json($ayantDroit,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(AyantDroit $ayantDroit)
    {
        //
        return $ayantDroit->load([
            'producteur',
            'parcelles'
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreAyantDroitRequest $request, AyantDroit $ayantDroit)
    {
        //
        $ayantDroit->update(
            $request->validated());

            return reponse()->json($ayantDroit);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AyantDroit $ayantDroit)
    {
        //
        $ayantDroit->delete();
        return reponse()->json([
            'message'=>'Ayant droit supprimer'
        ]);
    }
}
