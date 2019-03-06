<?php

namespace App\Http\Controllers\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
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
            "name"    => "required|min:2|max:190",
            "address"  => "required|string|min:3",
            "phone"  => "required",
            "company"  => "required|string|min:2|max:190",
            "email"  => "required|email",
        ];
    }



    public function messages()
    {
        return [
            'translatable.gb.title.required'  => 'Question is required',
            'translatable.gb.short_description.required'  => 'Answer is required'
        ];
    }
}
