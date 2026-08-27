<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreRecensementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
                        //  RECENSEMENT 
                                'mission_suivi_id' => ['required','exists:mission_suivis,id'],
                                'date_recensement' => ['required','date'],
                                'observation_recensement' => ['nullable','string','max:200'],
                                'parcelle_declaree' => ['nullable','integer','min:0'],
                                'nb_parcelle_levee' => ['nullable','integer','min:0'],
                                'parcelles_restant_levee' => ['nullable','integer','min:0'],
                        
                        //PRODUCTEUR
                                'producteur' => ['required','array'],
                                'producteur.nom' => ['required','string','max:100'],
                                'producteur.prenoms' => ['required','string','max:150'],
                                'producteur.contact' => ['nullable','string','max:20'],
                                'producteur.date_naissance' => ['nullable','date'],
                                'producteur.type_piece_identite' => ['nullable','string'],
                                'producteur.numero_piece' => ['nullable','string'],

                        //PARCELLES
                                'parcelles' => ['required','array','min:1'],
                                'parcelles.*.parcelle.code_parcelle' => ['required','string','max:50'],
                                'parcelles.*.parcelle.type_parcelle' => ['required','in:cacao,cafe'],
                                'parcelles.*.parcelle.superficie' => ['required','numeric','min:0'],
                                'parcelles.*.parcelle.localite_id' => ['required','exists:localites,id'],
                                'parcelles.*.parcelle.latitude' => ['nullable','numeric'],
                                'parcelles.*.parcelle.longitude' => ['nullable','numeric'],

                        //RECENSEMENT_PARCELLE
                                'parcelles.*.suivi.superficie_levee' => ['required','numeric','min:0'],
                                'parcelles.*.suivi.geolocalisee' => ['required','boolean'],



                ];

        
        }

     public function messages(): array
    {
        return [

            'mission_suivi_id.required' => 'Veuillez sélectionner une mission.',

            'producteur.nom.required' => 'Le nom est obligatoire.',

            'producteur.prenoms.required' => 'Le prénom est obligatoire.',

            'parcelles.required' => 'Ajoutez au moins une parcelle.',

            'parcelles.min' => 'Ajoutez au moins une parcelle.',

            'parcelles.*.parcelle.code_parcelle.required'
                => 'Le code de la parcelle est obligatoire.',

            'parcelles.*.parcelle.superficie.required'
                => 'La superficie est obligatoire.',

            'parcelles.*.parcelle.localite_id.required'
                => 'Veuillez sélectionner une localité.',

        ];
    }

}
