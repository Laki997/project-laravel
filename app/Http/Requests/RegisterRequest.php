<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'firstName' => 'required',
            'lastName'=>'required',
            'email' =>'required|unique:users,email',
            'password' => 'min:8|regex:/[0-9]/|confirmed',
            
        ];

    }
        public function messages()
        {
            return [ 
                'password.regex' => 'Password must have at least 8 charachters and also at least 1 digit! '
             ];
        }
}
