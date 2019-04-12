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
            'person.name.required' => 'The name is required',
            'person.father_last_name.required' => 'The last name is required',
            'person.department_id.required' => 'The department is required',
            'person.address.required' => 'Address 1 is required',
            'person.phone.required' => 'The phone is required',
            'person.phone.size' => 'The phone must contain 10 digits',
            'person.state_id.required' => 'The state is required',
            'person.email.required' => 'Mail is required',
            'person.email.email' => 'The format of the email is incorrect',
            'person.email.unique' => 'The email already exists',
            'person.city.required' => 'The city is required',
            'person.zip_code.required' => 'The zip code is required',
            'person.zip_code.size' => 'The postal code must contain 5 digits',
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
