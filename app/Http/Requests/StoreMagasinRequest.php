<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

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
        return [

            'code_magasin' => ['required','string','max:30','unique:magasins,code_magasin'],

            'operateur_id' => ['required','exists:operateurs,id'],

            'latitude' => ['nullable','numeric'],

            'longitude' => ['nullable','numeric'],

        ];
    }
}
