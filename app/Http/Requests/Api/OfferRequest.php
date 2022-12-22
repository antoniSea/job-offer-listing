<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class OfferRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'team_id' => 'required|integer|exists:teams,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'contact_number' => 'nullable|string|max:255',
            'contact_email' => 'nullable|string|max:255',
            'contact_city' => 'nullable|string|max:255',
            'contact_name' => 'nullable|string|max:255',
            'contact_address' => 'nullable|string|max:255',
            'contact_street' => 'nullable|string|max:255',
            'contact_postal_code' => 'nullable|string|max:255',
            'contact_country' => 'nullable|string|max:255'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));
    }
}
