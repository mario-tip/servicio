<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocationRequest extends FormRequest
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

    public function messages() {
        return [
            'location.description.required' => 'La descripción es requerida',
            'location.address.required' => 'La dirección es requerida',
            'location.building.required' => 'El edificio es requerido',
            'location.floor.required' => 'El piso es requerido'
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
            'location.description' => 'required',
            'location.address' => 'required',
            'location.building' => 'required',
            'location.floor' => 'required'
        ];
    }
}
