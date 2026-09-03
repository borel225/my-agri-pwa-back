<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSuiviUtilisationProducteurRequest;
use App\Models\SuiviUtilisationProducteur;
use Illuminate\Http\Request;

class SuiviUtilisationProducteurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return SuiviUtilisationProducteur::with([
            'producteur',
            'operateur',
            'missionSuivi.campagne',
            'missionSuivi.agent',
            'missionSuivi.localite.sousPrefecture.departement.delegationRegionale'
        ])
        ->orderBy('id','desc')
        ->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSuiviUtilisationProducteurRequest $request)
    {
        //
        $suivi = SuiviUtilisationProducteur::create(
            $request->validated()
        );

        return response()->json($suivi,201);

    }

    /**
     * Display the specified resource.
     */
    public function show(SuiviUtilisationProducteur $suiviUtilisationProducteur)
    {
        //
        return $suiviUtilisationProducteur->load([
            'producteur',
            'operateur',
            'missionSuivi.campagne',
            'missionSuivi.agent',
            'missionSuivi.localite.sousPrefecture.departement.delegationRegionale'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update( StoreSuiviUtilisationProducteurRequest $request,
        SuiviUtilisationProducteur $suiviUtilisationProducteur)
    {
        //
         $suiviUtilisationProducteur->update(
            $request->validated()
        );

        return response()->json($suiviUtilisationProducteur);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SuiviUtilisationProducteur $suiviUtilisationProducteur)
    {
        //
        $suiviUtilisationProducteur->delete();

        return response()->json([
            'message'=>'Suivi utilisation supprimé'
        ]);
    }
}
