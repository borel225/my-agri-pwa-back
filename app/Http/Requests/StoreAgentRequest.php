<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAgentRequest extends FormRequest
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
        $agent = $this->route('agent');
        $agentId = is_object($agent) ? $agent->id : $agent;

        return [
            'nom' => 'required|string|max:50',
            'prenoms' => 'nullable|string|max:100',
            'matricule' => [
                'required',
                'string',
                'max:30',
                Rule::unique('agents', 'matricule')->ignore($agentId), 
            ],
            'telephone' => 'nullable|string|max:20',
            'type_agent' => 'required|string|max:60',
            'delegation_regionale_id' => 'required|exists:delegation_regionales,id',
            'utilisateur_id' => [
                'nullable',
                'exists:users,id',
                Rule::unique('agents', 'utilisateur_id')->ignore($agentId),
            ],
        ]; 
    }

    /**
     * Messages de validation personnalisés en français.
     */
    public function messages(): array
    {
        return [
            'nom.required' => 'Le nom est obligatoire.',
            'matricule.required' => 'Le matricule est obligatoire.',
            'matricule.unique' => 'Ce matricule est déjà attribué à un autre agent.',
            'type_agent.required' => 'Le type d\'agent est obligatoire.',
            'delegation_regionale_id.required' => 'La délégation régionale est obligatoire.',
            'delegation_regionale_id.exists' => 'La délégation régionale sélectionnée n\'existe pas.',
            'utilisateur_id.unique' => 'Ce compte utilisateur est déjà associé à un autre agent.',
            'utilisateur_id.exists' => 'Le compte utilisateur sélectionné est invalide.',
        ];
    }
}

