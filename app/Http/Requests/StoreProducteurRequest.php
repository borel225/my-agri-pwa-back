<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProducteurRequest extends FormRequest
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
        $producteur = $this->route('producteur');
        $producteurId = is_object($producteur) ? $producteur->id : $producteur;

        return [
            'code_producteur' => [
                'required',
                'string',
                'max:30',
                Rule::unique('producteurs', 'code_producteur')->ignore($producteurId),
            ],
            'nom' => 'required|string|max:50',
            'prenoms' => 'required|string|max:100',
            'contact' => 'nullable|string|max:30',
            'date_naissance' => 'nullable|date',
            'type_piece_identite' => 'nullable|string|max:50',
            'numero_piece' => 'nullable|string|max:30',
            'statut_donnees' => 'nullable|string|max:30',
            'date_recensement' => 'required|date',
        ];
    }

    public function messages(): array
    {
        return [
            'code_producteur.required' => 'Le code producteur est obligatoire.',
            'code_producteur.unique' => 'Ce code producteur est déjà attribué.',
            'nom.required' => 'Le nom du producteur est obligatoire.',
            'prenoms.required' => 'Les prénoms du producteur sont obligatoires.',
            'date_recensement.required' => 'La date de recensement est obligatoire.',
        ];
    }
}
