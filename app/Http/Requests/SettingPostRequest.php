<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingPostRequest extends FormRequest
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
        $user = auth()->user();
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'nullable',
            'new_password' => 'sometimes|required|confirmed|min:6',
            'new_password_confirmation' => 'sometimes|required|min:6',
            'picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
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
            // 'email.regex'  => 'cette email est incorrecte',
            'new_password.required'  => 'Le nouveau mot de passe est obligatoire',
            'email.unique'  => 'l\'email existe déjà',
            'new_password.confirmed' => ' mot de passe ne confirme pas',
            'new_password.min'  => 'Le mot de passe doit contenir au moins 6 caratères',
            'picture.image'  => 'Saisir une image valide',
            'picture.mimes'  => 'Saisir une image valide',
        ];
    }
}
