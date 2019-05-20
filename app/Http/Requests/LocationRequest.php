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
          'location.name.required' => 'The name is required',
          'location.description.required' => 'The description is required ',
          'location.address.required' => 'The address is required',
          'location.building.required' => 'The building is required',
          'location.floor.required' => 'The floor ir required '
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
          'location.name' => 'required',
          'location.description' => 'required',
          'location.address' => 'required',
          'location.building' => 'required',
          'location.floor' => 'required'
        ];
    }
}
