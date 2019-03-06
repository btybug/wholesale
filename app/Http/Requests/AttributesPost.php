<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttributesPost extends FormRequest
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
            'icon' => 'required',
            "translatable.gb.name"  => "required",
        ];
    }

    public function messages()
    {
//        return [
//            'icon.required' => 'A icon is required',
//        ];
    }
}
