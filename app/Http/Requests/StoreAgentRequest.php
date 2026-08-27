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
         return [

        'nom' => 'required|string|max:50',

        'prenoms' => 'nullable|string|max:100',

        'matricule' => 'required|string|max:30|unique:agents,matricule',

        'telephone' => 'nullable|string|max:12',

        'type_agent' => 'required|string|max:60',

        'delegation_regionale_id' =>
            'required|exists:delegation_regionales,id',

        'utilisateur_id' => [
            'nullable',
            'exists:users,id',
            Rule::unique('agents', 'utilisateur_id'),
        ],

    ];
    
    }

}
