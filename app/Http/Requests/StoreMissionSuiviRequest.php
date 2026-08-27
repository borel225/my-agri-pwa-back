<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreMissionSuiviRequest extends FormRequest
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
            'campagne_id' => 'required|exists:campagnes,id',
            'agent_id' => 'required|exists:agents,id',
            'localite_id' => 'required|exists:localites,id',
            'observation' => 'nullable|string',
        ];
    }
}
