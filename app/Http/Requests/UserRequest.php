<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
    public function rules()
    {
        // $password_rule = '';
        // if ($this->method() == 'POST')
        //     $password_rule = 'required';
        // return [
        //     'name' => 'required',
        //     'email' => 'required|unique:users,email,' . $this->id,
        //     'password' => 'min:8|' . $password_rule,
        //     'username' => 'required',
        // ];
    }
}
