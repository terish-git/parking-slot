<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'phone_number' => 'required|min:3|max:15|unique:customers',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please enter customer name',
            'phone_number.required' => 'Please enter phone number',
            'phone_number.unique' => 'Phone number is already existing',
            'phone_number.min' => 'Minimum 3 number is required',
        ];
    }
}
