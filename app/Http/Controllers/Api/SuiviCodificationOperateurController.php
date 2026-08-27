<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSuiviCodificationOperateurRequest;
use App\Models\SuiviCodificationOperateur;
use Illuminate\Http\Request;

class SuiviCodificationOperateurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return SuiviCodificationOperateur::with([
            'operateur',
            'missionSuivi.campagne',
            'missionSuivi.agent',
            'missionSuivi.localite'
        ])
        ->orderBy('id','desc')
        ->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSuiviCodificationOperateurRequest $request)
    {
        //
         $suivi = SuiviCodificationOperateur::create(
            $request->validated()
        );

        return response()->json($suivi,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(SuiviCodificationOperateur $suiviCodificationOperateur)
    {
        //
            return $suiviCodificationOperateur->load([
                'operateur',
                'missionSuivi.campagne',
                'missionSuivi.agent',
                'missionSuivi.localite'
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreSuiviCodificationOperateurRequest $request,
        SuiviCodificationOperateur $suiviCodificationOperateur)
    {
        //
         $suiviCodificationOperateur->update(
            $request->validated()
        );

        return response()->json($suiviCodificationOperateur);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SuiviCodificationOperateur $suiviCodificationOperateur)
    {
        //
          $suiviCodificationOperateur->delete();

        return response()->json([
            'message' => 'Suivi codification opérateur supprimé'
        ]);
    }
}
