<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreAyantDroitRequest extends FormRequest
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

            'nom' => [
                'required',
                'string',
                'max:50'
            ],

            'prenoms' => [
                'required',
                'string',
                'max:100'
            ],

            'contact' => [
                'nullable',
                'string',
                'max:30'
            ],

            'date_naissance' => [
                'nullable',
                'date'
            ],

            'type_piece_identite' => [
                'nullable',
                'string',
                'max:50'
            ],

            'numero_piece' => [
                'nullable',
                'string',
                'max:20'
            ],

            'producteur_id' => [
                'nullable',
                'exists:producteurs,id'
            ],

        ];
    }
}
