<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProgramUpdateRequest extends FormRequest
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
            //
            'program_name' => 'required|unique:programs,program_name,'.$this->program->id,
            'sm_form'=>'required|max:5|min:2',
            'program_code' => 'required|unique:programs,program_code,'.$this->program->id,
        ];
    }
}
