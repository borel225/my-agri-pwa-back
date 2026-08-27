<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreDelegationRegionaleRequest extends FormRequest
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
         $delegation = $this->route('delegationRegionale');

        return [

            'code_dr' => [
                'required',
                'string',
                'max:20',
                Rule::unique('delegation_regionales', 'code_dr')
                    ->ignore($delegation)],

            'nom' => [
                'required',
                'string',
                'max:100']

        ];
    }
}
