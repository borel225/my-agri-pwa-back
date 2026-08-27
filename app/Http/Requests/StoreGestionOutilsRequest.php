<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreGestionOutilsRequest extends FormRequest
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
            'nombre_delegues_magasiniers_codifies' => ['nullable','integer','min:0'],
            'tpe_demande' => ['nullable','integer','min:0'],
            'tpe_recu' => ['nullable','integer','min:0'],
            'tpe_fonctionnel' => ['nullable','integer','min:0'],
            'tpe_non_fonctionnel' => ['nullable','integer','min:0'],
            'tpe_egare' => ['nullable','integer','min:0'],
            'scelles_demande' => ['nullable','integer','min:0'],
            'scelles_recu' => ['nullable','integer','min:0'],
            'scelles_projection' => ['nullable','integer','min:0'],
            'sacherie_demande' => ['nullable','integer','min:0'],
            'sacherie_recu' => ['nullable','integer','min:0'],
            'sacherie_projection' => ['nullable','integer','min:0'],
        ];
    }
}
