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
            'provider.name.required' => 'El nombre es requerido',
            'provider.phone.size' => 'El teléfono debe contener 10 dígitos',
            'provider.zip_code.size' => 'El código postal debe contener 5 dígitos',
            'provider.email.required' => 'El correo electrónico es requerido',
            'provider.email.email' => 'El formato de correo electrónico es incorrecto',
            'provider.state_id.required' => 'El estado es requerido',
            'provider.contact_phone.size' => 'El teléfono del contacto debe contener 10 dígitos',
            'provider.contact_email.email' => 'El formato de correo electrónico del contacto es incorrecto',
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
