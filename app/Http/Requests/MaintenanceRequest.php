<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MaintenanceRequest extends FormRequest
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
        switch($this->method()) {
            case 'POST':
                return [
                    'filter' => 'required',
                    'maintenance_date' => 'required',
                    'maintenance_time' => 'required',
                    'search' => 'required',
                    'notes' => 'required',
                ];
                break;

            case 'PUT':
                return [
                    'filter' => 'required',
                    'maintenance_date' => 'required',
                    'maintenance_time' => 'required',
                    'search' => 'required',
                    'notes' => 'required',
                ];
                break;
        }
    }
}
