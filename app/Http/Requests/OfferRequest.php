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
            'contact_number' => 'required|string|max:255',
            'contact_email' => 'required|string|max:255',
            'contact_city' => 'required|string|max:255',
            'contact_name' => 'required|string|max:255',
            'contact_address' => 'required|string|max:255',
            'contact_street' => 'required|string|max:255',
            'contact_postal_code' => 'required|string|max:255',
            'contact_country' => 'required|string|max:255',
        ];
    }
}
