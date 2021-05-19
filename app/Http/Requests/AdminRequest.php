<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
            'email'=>'unique:admins|email|required',
            'ph_no'=>'unique:admins|max:14|min:9|required',
            'name'=>'required|string',
            'address'=>'required|string',
        ];
    }
    public function message()
    {
          return [
            'email.required' => 'Email field could not be empty',
            'email.unique'=>'Email must be uniques, This email has already been taken',
            'ph_no.required' => 'Phone Number  field could not be empty',
            'ph_no.unique'=>'Phone Number must be uniques, This email has already been taken',
            'name.required'=>'Name field could not be empty',
            'address,required'=>'Address Field could not be empty',
         ];
    }
}
