<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSuiviCommercialisationRequest;
use App\Models\SuiviCommercialisation;
use Illuminate\Http\Request;

class SuiviCommercialisationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
            return SuiviCommercialisation::with([
            'missionSuivi.campagne',
            'missionSuivi.agent',
            'missionSuivi.localite',
            'operateur',
            'magasin'
        ])
        ->latest()
        ->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSuiviCommercialisationRequest $request)
    {
        //
            $suivi = SuiviCommercialisation::create(
            $request->validated()
        );
        return response()->json(
            $suivi->load([
                'missionSuivi.campagne',
                'missionSuivi.agent',
                'missionSuivi.localite',
                'operateur',
                'magasin'
            ]),201);
    }

    /**
     * Display the specified resource.
     */
    public function show(SuiviCommercialisation $suiviCommercialisation)
    {
        //
            return $suiviCommercialisation->load([
            'missionSuivi.campagne',
            'missionSuivi.agent',
            'missionSuivi.localite',
            'operateur',
            'magasin'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreSuiviCommercialisationRequest $request,
        SuiviCommercialisation $suiviCommercialisation)
    {
        //
            $suiviCommercialisation->update(
            $request->validated()
            );

        return response()->json(
            $suiviCommercialisation->load([
                'missionSuivi.campagne',
                'missionSuivi.agent',
                'missionSuivi.localite',
                'operateur',
                'magasin'
            ]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SuiviCommercialisation $suiviCommercialisation)
    {
        //
            $suiviCommercialisation->delete();

        return response()->json([
            'message' => 'Suivi de commercialisation supprimé.']);
    }
}
