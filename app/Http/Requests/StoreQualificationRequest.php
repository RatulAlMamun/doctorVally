<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQualificationRequest extends FormRequest
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
            'degree_id' => 'required|numeric',
            'institution_id' => 'required|numeric',
            'major' => 'string|nullable',
            'from_date' => 'required|date',
            'to_date' => 'required|date'
        ];
    }
}
