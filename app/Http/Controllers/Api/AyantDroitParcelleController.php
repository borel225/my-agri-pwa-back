<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AyantDroitParcelle;
use Illuminate\Http\Request;

class AyantDroitParcelleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
         return AyantDroitParcelle::with([
            'ayantDroit',
            'parcelle'
        ])
        ->orderBy('id','desc')
        ->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
         $data = $request->validate([

            'ayant_droit_id' => ['required','exists:ayant_droits,id'],
            'parcelle_id' => ['required','exists:parcelles,id'],
            'superficie_attribuee_ha' => ['required','numeric'],

        ]);

        $affectation = AyantDroitParcelle::create($data);

        return response()->json($affectation->load(['ayantDroit','parcelle']),201);
    }

    /**
     * Display the specified resource.
     */
    public function show(AyantDroitParcelle $ayantDroitParcelle)
    {
        //
         return $ayantDroitParcelle->load([
            'ayantDroit',
            'parcelle'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AyantDroitParcelle $ayantDroitParcelle)
    {
        //
            $data = $request->validate([

        'ayant_droit_id' => ['required','exists:ayant_droits,id'],
        'parcelle_id' => ['required','exists:parcelles,id'],
        'superficie_attribuee_ha' => ['required','numeric'],
        ]);

        $ayantDroitParcelle->update($data);

        return response()->json(
        $ayantDroitParcelle->load(['ayantDroit','parcelle']));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AyantDroitParcelle $ayantDroitParcelle)
    {
        //
        $ayantDroitParcelle->delete();


        return response()->json([
            'message'=>'Affectation supprimée'
        ]);
    }
}
