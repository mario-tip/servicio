<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IncidentRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }
}
    public function rules()
    {
        switch($this->method()) {
            case 'POST':
                return [
                    'asset_id' => 'required',
                    'type' => 'required',
                    'description' => 'required',
                    'person_id' => 'required',
                    'suggested_date' => 'required',
                    'suggested_time' => 'required',
                    'priority' => 'required',
                    'evidence_file' => 'required',
                ];
            break;

            case 'PUT':
                return [
                    'asset_id' => 'required',
                    'type' => 'required',
                    'description' => 'required',
                    'person_id' => 'required',
                    'suggested_date' => 'required',
                    'suggested_time' => 'required',
                    'priority' => 'required',
                ];
            break;
        }
    }
}
