<?php

namespace App\Http\Controllers\Api;


use App\Models\GestionLitige;
use App\Models\Producteur;
use App\Models\AyantDroit;
use App\Models\AyantDroitParcelle;
use App\Models\Parcelle;

use App\Http\Controllers\Controller;
//use App\Http\Requests\StoreGestionLitigeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class GestionLitigeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
            return GestionLitige::with([
            'missionSuivi.campagne',
            'missionSuivi.agent',
            'missionSuivi.localite.sousPrefecture.departement.delegationRegionale',
            'parcelle.producteur',
            'ayantDroits',
            'ayantDroits.parcelles'
            ])
            ->latest()
            ->get();
    }

    /**
     * Store a newly created resource in storage.
     */
 
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            // Vérifier qu'un litige est déjà ouvert
            $existe = GestionLitige::where('parcelle_id', $request->parcelle_id)
                ->whereIn('statut_litige', ['OUVERT', 'EN_COURS'])
                ->exists();

            if ($existe) {
                DB::rollBack();
                return response()->json([
                    'message' => 'Cette parcelle possède déjà un litige en cours.'
                ], 422);
            }

            // Création du litige
            $gestionLitige = GestionLitige::create([
                'mission_suivi_id' => $request->mission_suivi_id,
                'parcelle_id' => $request->parcelle_id,
                'motif_changement_propriete' => $request->motif_changement_propriete,
                'qualite_autorite_villageoise' => $request->qualite_autorite_villageoise,
                'nom_autorite_villageoise' => $request->nom_autorite_villageoise,
                'visa_autorite_villageoise' => $request->visa_autorite_villageoise,
                'date_collecte' => $request->date_collecte,
                'statut_litige' => 'OUVERT'
            ]);

            // Vérification de la superficie
            $parcelle = Parcelle::findOrFail($request->parcelle_id);
            $totalSuperficie = collect($request->ayants_droit)->sum('superficie_attribuee_ha');
            if ($totalSuperficie > $parcelle->superficie_ha) {
                DB::rollBack();
                return response()->json([
                    'message' => 'La superficie attribuée dépasse la superficie de la parcelle.'
                ], 422);
            }

            // Traitement des ayants droit
            foreach ($request->ayants_droit as $ayant) {
                if (!empty($ayant['est_producteur']) && $ayant['est_producteur']) {
                    $producteur = Producteur::findOrFail($ayant['producteur_id']);
                } else {
                    $producteur = Producteur::create([
                        'code_producteur' => strtoupper(uniqid('PRD')),
                        'nom' => $ayant['nom'] ?? null,
                        'prenoms' => $ayant['prenoms'] ?? null,
                        'contact' => $ayant['contact'] ?? null,
                        'date_naissance' => $ayant['date_naissance'] ?? null,
                        'type_piece_identite' => $ayant['type_piece_identite'] ?? null,
                        'numero_piece' => $ayant['numero_piece'] ?? null,
                        'statut_donnees' => 'LITIGE',
                        'date_recensement' => now()
                    ]);
                }

                // Ayant droit
                $ayantDroit = AyantDroit::create([
                    'nom' => $producteur->nom,
                    'prenoms' => $producteur->prenoms,
                    'contact' => $producteur->contact,
                    'date_naissance' => $producteur->date_naissance,
                    'type_piece_identite' => $producteur->type_piece_identite,
                    'numero_piece' => $producteur->numero_piece,
                    'producteur_id' => $producteur->id,
                    'gestion_litige_id' => $gestionLitige->id
                ]);

                // Attribution de la parcelle
                AyantDroitParcelle::create([
                    'ayant_droit_id' => $ayantDroit->id,
                    'parcelle_id' => $parcelle->id,
                    'superficie_attribuee_ha' => $ayant['superficie_attribuee_ha'] ?? 0
                ]);
            }

            DB::commit();
            return response()->json(
                $gestionLitige->load([
                    'missionSuivi.campagne',
                    'missionSuivi.localite.sousPrefecture.departement.delegationRegionale',
                    'parcelle.producteur',
                    'ayantDroits.producteur',
                    'ayantDroits.parcelles'
                ]), 201
            );

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 500);
        }

    }
    /**
     * Display the specified resource.
     */
    public function show(GestionLitige $gestionLitige)
    {
        //
        return $gestionLitige->load([
            'missionSuivi.campagne',
            'missionSuivi.agent',
            'missionSuivi.localite',
            'parcelle.producteur',
            'ayantDroits',
            'ayantDroits.parcelles'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update( StoreGestionLitigeRequest $request,
        GestionLitige $gestionLitige)
    {
        //
         $gestionLitige->update($request->validated());

        return response()->json($gestionLitige->load(['missionSuivi','parcelle.producteur']));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GestionLitige $gestionLitige)
    {
        //
            DB::beginTransaction();
        try {
            foreach ($gestionLitige->ayantDroits as $ayantDroit) {
                // Supprime les lignes de la table pivot
                 $ayantDroit->parcelles()->detach();

                // Supprime l'ayant droit
                $ayantDroit->delete();
            }

            // Supprime le litige
            $gestionLitige->delete();

            DB::commit();

            return response()->json([
                'message' => 'Litige supprimé avec succès.'
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'message' => $e->getMessage()
            ], 500);

        }
    }

   public function withValidator($validator)
    {
        $validator->after(function ($validator) {

            foreach ($this->input('ayants_droit', []) as $index => $ayant) {

                if ($ayant['est_producteur']) {

                    if (empty($ayant['producteur_id'])) {

                        $validator->errors()->add(
                            "ayants_droit.$index.producteur_id",
                            "Veuillez sélectionner un producteur."
                        );

                    }

                } else {

                    if (empty($ayant['nom'])) {

                        $validator->errors()->add(
                            "ayants_droit.$index.nom",
                            "Le nom est obligatoire."
                        );

                    }

                    if (empty($ayant['prenoms'])) {

                        $validator->errors()->add(
                            "ayants_droit.$index.prenoms",
                            "Les prénoms sont obligatoires."
                        );

                    }

                }

            }

        });
    }
}
