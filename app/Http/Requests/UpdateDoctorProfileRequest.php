<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateDoctorProfileRequest extends FormRequest
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
            'name' => 'string',
            'phone' => [
                'string',
                'unique:users,phone,'.Auth::id(),
                'regex:/^(?:\+88)01[13-9]\d{8}$/'
            ],
            'email' => 'email|string',
            'gender' => 'string|in:male,female,other',
            'address' => 'string',
            'bio' => 'string',
            'facebook' => 'string|url',
            'youtube' => 'string|url',
            'linkedin' => 'string|url',
            'twitter' => 'string|url'
        ];
    }
}
