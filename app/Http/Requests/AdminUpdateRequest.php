<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUpdateRequest extends FormRequest
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
            'email' => 'required|email|unique:admins,email,'.$this->admin->id,
            'ph_no' => 'required|unique:admins,ph_no,'.$this->admin->id,
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
