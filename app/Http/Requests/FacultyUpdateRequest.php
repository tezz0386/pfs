<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FacultyUpdateRequest extends FormRequest
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
            'faculty_name' => 'required|unique:faculties,faculty_name,'.$this->faculty->id,
            'faculty_code' => 'required|unique:faculties,faculty_code,'.$this->faculty->id,
        ];
    }
}
