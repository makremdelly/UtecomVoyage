<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VoyagePostRequest extends FormRequest
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
            'type' => 'required|string|max:255',
            'nbplace' => 'required|string|max:255',
            'villeD' => 'required|string|max:255',
            'depart' => 'required|string|max:255',
            'retour' => 'required|required|max:6',
            'startDate' => 'required|required|max:255',
            'endDate' => 'required|required|max:255',
            'prix' => 'required|required|max:255',
            'autocar' => 'required|required|max:255',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|required|max:10000000'

        ];
    }

    public function messages()
    {
        return [
            'type.required' => 'Le type est obligatoire',
            'nbplace.required'  => 'Le nombre de place est obligatoire',
            'villeD.required'  => 'La ville de depart est obligatoire',
            'depart.required'  => 'la destination est obligatoire' ,
            'retour.required' => ' ville d arrivee est obligatoire',
            'startDate.required'  => 'Le date de depart est obligatoire',
            'endDate.required'  => 'Le date d arrivee est obligatoire',
            'prix.required'  => 'L autocar est obligatoire',
            'prix.required'  => 'prix est obligatoire',
            'photo.image'  => 'Saisir une image valide',
            'description.required'  => 'description est obligatoire',
        ];
    }

}
