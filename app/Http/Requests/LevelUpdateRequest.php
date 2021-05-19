<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LevelUpdateRequest extends FormRequest
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
            'level_name' => 'required|unique:levels,level_name,'.$this->level->id,
            'level_code' => 'unique:levels,level_code,'.$this->level->id,
        ];
    }
}
