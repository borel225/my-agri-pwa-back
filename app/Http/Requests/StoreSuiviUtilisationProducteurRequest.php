<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreSuiviUtilisationProducteurRequest extends FormRequest
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

            'producteur_id' => ['required','exists:producteurs,id'],
            'operateur_id' => ['nullable','exists:operateurs,id'],
            'mission_suivi_id' => ['required','exists:mission_suivis,id'],
            'date_passage' => ['required','date'],
            'statut_recense' => ['nullable','boolean'],
            'etat_carte' => ['nullable','string','max:30'],
            'type_incident' => ['nullable','string','max:200'],

        ];
    }
}
