<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRecensementRequest;
use App\Http\Requests\UpdateRecensementRequest;
use App\Models\Recensement;
use App\Models\Producteur;
use App\Models\Parcelle;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;



class RecensementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Recensement::with([
            'producteur',
            'missionSuivi.campagne',
            'missionSuivi.agent',
            'missionSuivi.localite.sousPrefecture.departement.delegationRegionale',
            'parcelles.localite'
        ])
        ->orderBy('id', 'desc')
        ->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRecensementRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();

            //1 - Création du producteur
            $producteurData = $data['producteur'];
            $producteur = Producteur::create([
                'code_producteur' => 
                    'PRD-CI'.str_pad(
                        Producteur::count()+1,
                        4,
                        '0',
                        STR_PAD_LEFT
                    ),
                'nom' => $producteurData['nom'],
                'prenoms' => $producteurData['prenoms'],
                'contact' => $producteurData['contact'] ?? null,
                'date_naissance' =>$producteurData['date_naissance'] ?? null,
                'type_piece_identite' =>$producteurData['type_piece_identite'] ?? null,
                'numero_piece' =>$producteurData['numero_piece'] ?? null,
                'statut_donnees' => 'ENREGISTRE',
                'date_recensement' => now(),
            ]);

            //2 - Création du recensement
            $recensement = Recensement::create([
                'producteur_id' => $producteur->id,'mission_suivi_id' => $data['mission_suivi_id'],
                'date_recensement' =>$data['date_recensement'],
                'observation_recensement' =>$data['observation_recensement'] ?? null,
                'parcelle_declaree' =>$data['parcelle_declaree'] ?? 0,
                'nb_parcelle_levee' =>$data['nb_parcelle_levee'] ?? 0,
                'parcelles_restant_levee' =>$data['parcelles_restant_levee'] ?? 0,
            ]);

            //3 - Création des parcelles
            foreach($data['parcelles'] as $item){
                $parcelleData = $item['parcelle'];
                $parcelle = Parcelle::create([
                    'producteur_id' => $producteur->id,
                    'code_parcelle' =>$parcelleData['code_parcelle'] ?? null,
                    'type_parcelle' =>$parcelleData['type_parcelle'],
                    'superficie_ha' =>$parcelleData['superficie'],
                    'localite_id' =>$parcelleData['localite_id'],
                    'latitude' =>$parcelleData['latitude'] ?? null,
                    'longitude' =>$parcelleData['longitude'] ?? null,
                ]);

            //4 - Table pivot recensement_parcelle
                $recensement->parcelles()->attach(
                        $parcelle->id,
                        [
                            'superficie_levee' =>$item['suivi']['superficie_levee'],
                            'geolocalisee' =>$item['suivi']['geolocalisee']
                        ]
                    );
            }

            DB::commit();
            return response()->json([
                'message'=>'Recensement enregistré avec succès',
                'data'=>$recensement->load('producteur','parcelles')
            ],201);

        }catch(\Exception $e){

            DB::rollBack();
            return response()->json([
                'message'=>'Erreur lors de l’enregistrement',
                'error'=>$e->getMessage()
            ],500);
        }

    }
    /**
     * Display the specified resource.
     */
    public function show(Recensement $recensement)
    {
        //
            return $recensement->load([
            'producteur',
            'missionSuivi.campagne',
            'missionSuivi.agent',
            // Toute la hiérarchie
            'missionSuivi.localite.sousPrefecture.departement.delegationRegionale',
            'parcelles.localite',

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
        public function update(UpdateRecensementRequest $request, Recensement $recensement)
    {
        DB::transaction(function () use ($request, $recensement) {

            // 1 - Modifier le producteur
            $recensement->producteur->update([
                'nom' => $request->producteur['nom'],
                'prenoms' => $request->producteur['prenoms'],
                'contact' => $request->producteur['contact'],
                'date_naissance' => $request->producteur['date_naissance'],
                'type_piece_identite' => $request->producteur['type_piece_identite'],
                'numero_piece' => $request->producteur['numero_piece'],
                'statut_donnees' => 'ENREGISTRE'
            ]);

            // 2 - Modifier le recensement
            $recensement->update([
                'mission_suivi_id' =>$request->mission_suivi_id,
                'date_recensement' =>$request->date_recensement,
                'observation_recensement' =>$request->observation_recensement,
                'parcelle_declaree' =>count($request->parcelles),
                'nb_parcelle_levee' =>count($request->parcelles),
                'parcelles_restant_levee'=>0
            ]);

            // Récupérer les ids des parcelles conservées
            $idsParcelles = [];

            foreach ($request->parcelles as $item) {

                // -------------------------
                // Parcelle existante
                // -------------------------
                if (!empty($item['parcelle']['id'])) {
                    $parcelle = Parcelle::find($item['parcelle']['id']);
                    if ($parcelle) {
                        $parcelle->update([
                            'code_parcelle' => $item['parcelle']['code_parcelle'],
                            'type_parcelle' => $item['parcelle']['type_parcelle'],
                            'superficie_ha' => $item['parcelle']['superficie'],
                            'localite_id' => $item['parcelle']['localite_id']
                        ]);
                        $idsParcelles[] = $parcelle->id;
                        $recensement->parcelles()->updateExistingPivot(
                            $parcelle->id,
                            [
                                'superficie_levee' => $item['suivi']['superficie_levee'],
                                'geolocalisee' => $item['suivi']['geolocalisee']
                            ]
                        );
                    }
                }

                // -------------------------
                // Nouvelle parcelle
                // -------------------------
                else {
                    $parcelle = Parcelle::create([
                        'producteur_id' => $recensement->producteur_id,
                        'code_parcelle' => $item['parcelle']['code_parcelle'],
                        'type_parcelle' => $item['parcelle']['type_parcelle'],
                        'superficie_ha' => $item['parcelle']['superficie'],
                        'localite_id' => $item['parcelle']['localite_id']
                    ]);
                    $idsParcelles[] = $parcelle->id;
                    $recensement->parcelles()->attach(
                        $parcelle->id,
                        [
                            'superficie_levee' => $item['suivi']['superficie_levee'],
                            'geolocalisee' => $item['suivi']['geolocalisee']
                        ]
                    );
                }
            }
        });

        return response()->json([
            'message'=>'Recensement modifié avec succès'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recensement $recensement)
    {
        //
          $recensement->delete();
        return response()->json([
            'message'=>'Recensement supprimé avec succès'
        ]);
    }
}
