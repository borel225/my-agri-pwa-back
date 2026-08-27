<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreGestionLitigeRequest extends FormRequest
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

                 'mission_suivi_id' => [
            'required',
            'exists:mission_suivis,id'
        ],

        'parcelle_id' => [
            'required',
            'exists:parcelles,id'
        ],

        'motif_changement_propriete' => [
            'nullable',
            'string',
            'max:100'
        ],

        'qualite_autorite_villageoise' => [
            'nullable',
            'string',
            'max:100'
        ],

        'nom_autorite_villageoise' => [
            'nullable',
            'string',
            'max:100'
        ],

        'visa_autorite_villageoise' => [
            'boolean'
        ],

        'date_collecte' => [
            'required',
            'date'
        ],

        'ayants_droit' => [
            'required',
            'array',
            'min:1'
        ],

        'ayants_droit.*.est_producteur' => [
            'required',
            'boolean'
        ],

        'ayants_droit.*.producteur_id' => [
            'nullable',
            'exists:producteurs,id'
        ],

        'ayants_droit.*.nom' => [
            'nullable',
            'string',
            'max:50'
        ],

        'ayants_droit.*.prenoms' => [
            'nullable',
            'string',
            'max:100'
        ],

        'ayants_droit.*.contact' => [
            'nullable',
            'string',
            'max:30'
        ],

        'ayants_droit.*.date_naissance' => [
            'nullable',
            'date'
        ],

        'ayants_droit.*.type_piece_identite' => [
            'nullable',
            'string',
            'max:50'
        ],

        'ayants_droit.*.numero_piece' => [
            'nullable',
            'string',
            'max:30'
        ],

        'ayants_droit.*.superficie_attribuee_ha' => [
            'required',
            'numeric',
            'min:0.01'
        ]

    ];
             
    }
}
