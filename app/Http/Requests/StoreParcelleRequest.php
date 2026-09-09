<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreParcelleRequest extends FormRequest
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
        $parcelle = $this->route('parcelle');
        $parcelleId = is_object($parcelle) ? $parcelle->id : $parcelle;

        return [
            'producteur_id' => 'required|exists:producteurs,id',
            'code_parcelle' => [
                'required',
                'string',
                'max:30',
                Rule::unique('parcelles', 'code_parcelle')->ignore($parcelleId),
            ],
            'type_parcelle' => 'required|string|max:50',
            'superficie_ha' => 'nullable|numeric|min:0',
            'localite_id' => 'required|exists:localites,id',
            'latitude' => 'nullable',
            'longitude' => 'nullable',
        ];
    }

    public function messages(): array
    {
        return [
            'producteur_id.required' => 'Le producteur est obligatoire.',
            'producteur_id.exists' => 'Le producteur sélectionné est invalide.',
            'code_parcelle.required' => 'Le code parcelle est obligatoire.',
            'code_parcelle.unique' => 'Ce code parcelle est déjà utilisé.',
            'type_parcelle.required' => 'Le type de parcelle est obligatoire.',
            'localite_id.required' => 'La localité est obligatoire.',
            'localite_id.exists' => 'La localité sélectionnée est invalide.',
        ];
    }
}
