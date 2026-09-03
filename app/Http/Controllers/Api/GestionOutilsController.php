<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGestionOutilsRequest;
use App\Models\GestionOutils;
use Illuminate\Http\Request;

class GestionOutilsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
         return GestionOutils::with([
            'missionSuivi.campagne',
            'missionSuivi.agent',
            'missionSuivi.localite.sousPrefecture.departement.delegationRegionale',
            'operateur'
        ])
        ->latest()
        ->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGestionOutilsRequest $request)
    {
        //
        $gestionOutils = GestionOutils::create(
            $request->validated()
        );

        return response()->json(
            $gestionOutils->load([
                'missionSuivi.campagne',
                'missionSuivi.agent',
                'missionSuivi.localite.sousPrefecture.departement.delegationRegionale',
                'operateur'
            ]),201);
    }

    /**
     * Display the specified resource.
     */
    public function show(GestionOutils $gestionOutil)
    {
        //
        return response()->json(
            $gestionOutil->load([
                'missionSuivi.campagne',
                'missionSuivi.agent',
                'missionSuivi.localite.sousPrefecture.departement.delegationRegionale',
                'operateur'
            ]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreGestionOutilsRequest $request,
        GestionOutils $gestionOutil)
    {
        //
        $gestionOutil->update(
            $request->validated()
        );

        return response()->json(
            $gestionOutil->load([
                'missionSuivi.campagne',
                'missionSuivi.agent',
                'missionSuivi.localite.sousPrefecture.departement.delegationRegionale',
                'operateur'
            ])
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GestionOutils $gestionOutil)
    {
        //
         $gestionOutil->delete();

        return response()->json([
            'message' => 'Gestion des outils supprimée.'
        ]);
    }
}
