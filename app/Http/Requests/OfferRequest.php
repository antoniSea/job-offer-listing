<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'contact_number' => 'nullable|string|max:255',
            'contact_email' => 'nullable|string|max:255',
            'contact_city' => 'nullable|string|max:255',
            'contact_name' => 'nullable|string|max:255',
            'contact_address' => 'nullable|string|max:255',
            'contact_street' => 'nullable|string|max:255',
            'contact_postal_code' => 'nullable|string|max:255',
            'contact_country' => 'nullable|string|max:255',
        ];
    }
}
