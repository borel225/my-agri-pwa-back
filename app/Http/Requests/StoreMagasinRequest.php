<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMagasinRequest extends FormRequest
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
        $magasin = $this->route('magasin');
        $magasinId = is_object($magasin) ? $magasin->id : $magasin;

        return [
            'code_magasin' => [
                'required',
                'string',
                'max:30',
                Rule::unique('magasins', 'code_magasin')->ignore($magasinId),
            ],
            'operateur_id' => ['required', 'exists:operateurs,id'],
            'latitude' => ['nullable', 'numeric'],
            'longitude' => ['nullable', 'numeric'],
        ];
    }

    public function messages(): array
    {
        return [
            'code_magasin.required' => 'Le code magasin est obligatoire.',
            'code_magasin.unique' => 'Ce code magasin est déjà utilisé.',
            'operateur_id.required' => 'L\'opérateur est obligatoire.',
            'operateur_id.exists' => 'L\'opérateur sélectionné est invalide.',
        ];
    }
}
