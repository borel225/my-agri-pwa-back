<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

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
        return [
        'producteur_id' => 'required|exists:producteurs,id',

        'code_parcelle' => 'required|string|max:30|unique:parcelles,code_parcelle',

        'type_parcelle' => 'required|string|max:50',

        'superficie_ha' => 'nullable|numeric|min:0',

        'localite_id' => 'required|exists:localites,id',
        
        'latitude' => 'nullable',

        'longitude' => 'nullable',
    ];
    }
}
