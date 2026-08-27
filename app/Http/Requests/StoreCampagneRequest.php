<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCampagneRequest extends FormRequest
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
                'code_semaine' => ['required','string','max:20'],
                'libelle' => ['required','string','max:100'],
                'date_debut' => ['required','date'],
                'date_fin' => ['required','date','after_or_equal:date_debut'],
                'statut' => ['required','in:ACTIVE,CLOTUREE'],
                'observation' => ['nullable','string']
             ];
    }
}
