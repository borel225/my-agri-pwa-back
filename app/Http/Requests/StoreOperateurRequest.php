<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreOperateurRequest extends FormRequest
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
        $operateur = $this->route('operateur');
        $operateurId = is_object($operateur) ? $operateur->id : $operateur;

        return [
            'code_operateur' => [
                'required',
                'string',
                'max:30',
                Rule::unique('operateurs', 'code_operateur')->ignore($operateurId),
            ],
            'sigle_operateur' => ['required', 'string', 'max:100'],
            'departement_id' => ['required', 'exists:departements,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'code_operateur.required' => 'Le code opérateur est obligatoire.',
            'code_operateur.unique' => 'Ce code opérateur est déjà utilisé.',
            'sigle_operateur.required' => 'Le sigle de l\'opérateur est obligatoire.',
            'departement_id.required' => 'Le département est obligatoire.',
            'departement_id.exists' => 'Le département sélectionné est invalide.',
        ];
    }
}
