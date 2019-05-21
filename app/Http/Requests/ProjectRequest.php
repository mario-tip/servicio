<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'project.name.required' => 'The name is required',
            'project.description.required' => 'The description is required',
            'project.id_project.required' => 'The name Id project is required'
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
            'project.name' => 'required',
            'project.description' => 'required',
            'project.id_project' => 'required'
        ];
    }
}
