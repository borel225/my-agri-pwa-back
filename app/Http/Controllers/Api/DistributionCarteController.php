<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDistributionCarteRequest;
use App\Models\DistributionCarte;
use Illuminate\Http\Request;

class DistributionCarteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return DistributionCarte::with([
            'producteur',
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
    public function store(StoreDistributionCarteRequest $request)
    {
        //
        $distribution = DistributionCarte::create(
            $request->validated()
        );

        return response()->json($distribution, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(DistributionCarte $distributionCarte)
    {
        //
                return $distributionCarte->load([
            'producteur.parcelles',
            'missionSuivi.campagne',
            'missionSuivi.agent',
            'missionSuivi.localite.sousPrefecture.departement.delegationRegionale'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update( StoreDistributionCarteRequest $request,
        DistributionCarte $distributionCarte)
    {
        //
         $distributionCarte->update(
            $request->validated()
        );

        return response()->json($distributionCarte);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DistributionCarte $distributionCarte)
    {
        //
        $distributionCarte->delete();

        return response()->json([
            'message'=>'Distribution supprimée avec succès'
        ]);
    }
}
