<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceOrderRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages() {
        return [
            'service_order.user_id.required' => 'El en cargado de resolución es requerido',
            'service_order.date.required' => 'La fecha es requerida',
            'service_order.time.required' => 'La hora es requerida'
        ];
    }
    public function rules()
    {
        return [
            'service_order.user_id' => 'required',
            'service_order.date' => 'required',
            'service_order.time' => 'required'
        ];
    }
}
