<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreSuiviCodificationOperateurRequest extends FormRequest
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

            'operateur_id' => ['required','exists:operateurs,id'],

            'mission_suivi_id' => ['required','exists:mission_suivis,id'],

            'demande_soumise' => ['required','boolean'],

            'demande_traitee_dr' => ['nullable','boolean'],

            'demande_validee_stpt' => ['nullable','boolean'],

            'observation_codification' => ['nullable','string'],

            'nbre_delegues_sydore' => ['nullable','integer','min:0'],

            'nbre_delegues_setbc' => ['nullable','integer','min:0'],

            'nbre_cartes_editees' => ['nullable','integer','min:0'],

            'nbre_magasin_geolocalise' => ['nullable','integer','min:0'],

            'observation_personnel' => ['nullable','string'],

            'kyc_soumis' => ['nullable','boolean'],

            'kyc_valide' => ['nullable','boolean'],

            'motif_non_conformite' => ['nullable','string','max:200'],

            'operateur_forme_deploye' => ['nullable','boolean'],

            'observation_enrolement' => ['nullable','string'],
        ];
    }
}
