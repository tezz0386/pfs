<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CrashRequest extends FormRequest
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
            'crash_name'=>'required|unique:crashes',
            'crash_image'=>'required'
        ];
    }
}
