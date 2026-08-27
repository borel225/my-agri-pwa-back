<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreSuiviCommercialisationRequest extends FormRequest
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
            'mission_suivi_id' => ['required','exists:mission_suivis,id'],
            'operateur_id' => ['required','exists:operateurs,id'],
            'magasin_id' => ['required','exists:magasins,id'],
            'date_passage' => ['required','date'],
            'volumes_physiques' => ['nullable','numeric','min:0'],
            'volumes_setbc' => ['nullable','numeric','min:0'],
            'connaissement_emis' => ['nullable','integer','min:0'],
            'connaissement_receptionne' => ['nullable','integer','min:0'],
            'connaissement_refoule' => ['nullable','integer','min:0'],
            'nb_sacs_sans_scelles' => ['nullable','integer','min:0'],
            'motif_sacs_sans_scelles' => ['nullable','required_if:nb_sacs_sans_scelles,>,0','string' ],
            'nbre_produ_preenregistres' => ['nullable','integer','min:0'],
            'motif_enquete' => ['nullable','string','max:200'],
            'observation_enquete' => ['nullable','string']
        ];
    }
}
