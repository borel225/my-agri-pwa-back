<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreDistributionCarteRequest extends FormRequest
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

            'mission_suivi_id' => ['required','exists:mission_suivis,id'],

            'date_distribution' => ['required','date'],

            'lieu_distribution' => ['nullable','string','max:150'],

            'telephone_kyc' => ['nullable','string','max:30'],

            'kyc_synchronise' => ['nullable','boolean'],

            'carte_activee' => ['nullable','boolean'],

            'motif_non_activation' => ['nullable','string','max:200'],
        ];
    }
}
