<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProviderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'provider.name.required' => 'The name is required',
            'provider.phone.size' => 'The phone must contain 10 digits',
            'provider.zip_code.size' => 'The zip code must contain 5 digits',
            'provider.email.required' => 'The E-mail is required',
            'provider.email.email' => 'The E-mail format is incorrect',
            'provider.state_id.required' => 'The state is required',
            'provider.contact_phone.size' => "The contact's phone must contain 10 digits",
            'provider.contact_email.email' => "The contact's email format is incorrect",
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'provider.name' => 'required',
            'provider.phone' => 'size:10',
            'provider.zip_code' => 'size:5',
            'provider.email' => 'required|email',
            'provider.state_id' => 'required',
            'provider.contact_phone' => 'size:10',
            'provider.contact_email' => 'email',
        ];
    }
}
