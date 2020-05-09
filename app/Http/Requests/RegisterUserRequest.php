<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|email|unique:users',
            'password' => 'required|string|min:6'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Le nom est obligatoire',
            'email.required'  => 'L\'email est obligatoire',
            'password.required'  => 'Le mot de passe est obligatoire',
            'email.unique'  => 'l\'email existe déjà',
            'password.min'  => 'Le mot de passe doit contenir au moins 6 caratères'
        ];
    }
}
