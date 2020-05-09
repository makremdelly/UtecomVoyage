<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProgrammePostRequest extends FormRequest
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
            'jour[]' => 'bail|required|min:1',
            'programme[]' => 'sometimes|required|min:6'
        ];
    }
    public function messages()
    {
        return [
            'jour.required' => 'Le jour est obligatoire',
            'programme.required'  => 'Le programme est obligatoire',
        ];
    }
}
