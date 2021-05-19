<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UniversityUpdateRequest extends FormRequest
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
            'university_name' => 'required|unique:universities,university_name,'.$this->university->id,
            'sm_form'=>'required|max:5|min:2',
            'university_code' => 'required|unique:universities,university_code,'.$this->university->id,
        ];
    }
    public function message()
    {
        return [
            'university_name.required'=>'The Name Field could not be empty',
            'university_name.unique'=>'The University Name must be unique, This has already taken',
            'sm_form.required'=>'This small form of university could not be empty',
            'university_code.unique'=>'The University Code must be ubique, this has already been taken'
        ];
    }
}
