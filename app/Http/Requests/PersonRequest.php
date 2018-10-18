<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Person;

class PersonRequest extends FormRequest
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
            'person.name.required' => 'El nombre es requerido',
            'person.father_last_name.required' => 'El apellido paterno es requerido',
            'person.mother_last_name.required' => 'El apellido materno es requerido',
            'person.department_id.required' => 'El departamento es requerido',
            'person.address.required' => 'La dirección 1 es requerida',
            'person.phone.required' => 'El teléfono es requerido',
            'person.phone.size' => 'El teléfono debe contener 10 dígitos',
            'person.state_id.required' => 'El estado es requerido',
            'person.email.required' => 'El correo es requerido',
            'person.email.email' => 'El formato del correo es incorrecto',
            'person.email.unique' => 'El correo ya existe',
            'person.city.required' => 'La ciudad es requerida',
            'person.zip_code.required' => 'El código postal es requerido',
            'person.zip_code.size' => 'El código postal debe contener 5 dígitos',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $validations = [
            'person.name' => 'required',
            'person.father_last_name' => 'required',
            'person.mother_last_name' => 'required',
            'person.department_id' => 'required',
            'person.address' => 'required',
            'person.phone' => 'required|size:10',
            'person.state_id' => 'required',
            'person.city' => 'required',
            'person.zip_code' => 'required|size:5',
        ];
        switch($this->method()) {
            case 'POST':
                $validations['person.email'] = 'required|email|unique:users,email';
                return $validations;
            case 'PUT':
                $validations['person.email'] = 'required|email';
                $person = Person::find($this->input()['id']);
                if($person->email != $this->get('person')['email']) {
                    $validations['person.email'] = 'required|email|unique:users,email';
                }
                return $validations;
        }
    }
}
