<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

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
        return [
        'code_producteur' => 'required|string|max:30|unique:producteurs,code_producteur',

        'nom' => 'required|string|max:50',

        'prenoms' => 'required|string|max:100',

        'contact' => 'nullable|string|max:30',

        'date_naissance' => 'nullable|date',

        'type_piece_identite' => 'nullable|string|max:50',

        'numero_piece' => 'nullable|string|max:20',

        'statut_donnees' => 'nullable|string|max:30',

        'date_recensement' => 'required|date',
         ];
    }
}
