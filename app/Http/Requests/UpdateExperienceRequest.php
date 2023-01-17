<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExperienceRequest extends FormRequest
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
        return [
            'organization' => 'required|string',
            'designation' => 'required|string',
            'from_date' => 'required|date',
            'current_working' => 'boolean',
            'to_date' => 'required_if:current_working,false|date',
            'location' => 'required|string'
        ];
    }
}
