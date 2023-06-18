<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePosologieRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'voie' => ['string', 'max:2', Rule::in(['IM', 'SC', 'PO', 'VO'])],
            'posologie' => ['string', 'max:191'],
            'lait' => ['string', 'max:191'],
            'viande' => ['string', 'max:191'],
        ];
    }
}
