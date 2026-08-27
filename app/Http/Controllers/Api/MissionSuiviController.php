<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMissionSuiviRequest;
use App\Models\MissionSuivi;
use Illuminate\Http\Request;

class MissionSuiviController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
            return MissionSuivi::with([
            'campagne',
            'agent.delegationRegionale',
            'localite.sousPrefecture.departement.delegationRegionale'])
            ->orderBy('id', 'desc')
            ->get()
            ->map(function ($mission) {

            return [
                'id' => $mission->id,
                'code_mission' => $mission->code_mission,
                'date_mission' => $mission->date_mission,
                'observation' => $mission->observation,
                'statut' => $mission->statut,
                'campagne' => [
                    'id' => $mission->campagne->id,
                    'code_semaine' => $mission->campagne->code_semaine,
                ],

                'agent' => [
                    'id' => $mission->agent->id,
                    'nom' => $mission->agent->nom,
                    'prenoms' => $mission->agent->prenoms,
                    'matricule' => $mission->agent->matricule,
                ],

                'delegation' => [
                    'id' => $mission->localite->sousPrefecture->departement->delegationRegionale->id,
                    'nom' => $mission->localite->sousPrefecture->departement->delegationRegionale->nom,
                ],

                'departement' => [
                    'id' => $mission->localite->sousPrefecture->departement->id,
                    'nom' => $mission->localite->sousPrefecture->departement->nom,
                ],

                'sous_prefecture' => [
                    'id' => $mission->localite->sousPrefecture->id,
                    'nom' => $mission->localite->sousPrefecture->nom,
                ],

                'localite' => [
                    'id' => $mission->localite->id,
                    'nom' => $mission->localite->nom,
                ],
            ];
        });
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMissionSuiviRequest $request)
    {
        //
         $mission = MissionSuivi::create(
            $request->validated()
        );

         return response()->json($mission->load([
                'campagne',
                'agent.delegationRegionale',
                'localite.sousPrefecture.departement.delegationRegionale'
            ]),201);
    }

    /**
     * Display the specified resource.
     */
    public function show(MissionSuivi $missionSuivi)
    {
        //
        return $missionSuivi->load([
            'campagne',
            'agent.delegationRegionale',
            'localite.sousPrefecture.departement.delegationRegionale'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreMissionSuiviRequest $request, MissionSuivi $missionSuivi)
    {
        //
        $missionSuivi->update(
            $request->validated()
        );

         return $missionSuivi->load([
            'campagne',
            'agent.delegationRegionale',
            'localite.sousPrefecture.departement.delegationRegionale'
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MissionSuivi $missionSuivi)
    {
        //
        $missionSuivi->delete();

        return response()->json([
            'message'=>'Mission supprimée avec succès'
        ]);
    }


}
