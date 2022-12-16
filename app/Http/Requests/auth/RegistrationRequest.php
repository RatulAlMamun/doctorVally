<?php

namespace App\Http\Requests\auth;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
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
            'name' => 'required|string|min:3',
            'phone' => [
                'required',
                'string',
                'unique:users,phone',
                'regex:/^(?:\+88)01[13-9]\d{8}$/'
            ],
            'email' => 'email',
            'bmdc_no' => 'required_if:role,doctor|string|unique:doctors,bmdc_no',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required|min:8',
            'role' => 'required|string|in:doctor,chamber',
            'location' => 'required_if:role,chamber|string'
        ];
    }
}
