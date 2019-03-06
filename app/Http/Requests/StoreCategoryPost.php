<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryPost extends FormRequest
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
            'icon' => 'required|string|min:5',
            "translatable"    => "required|array|min:1",
            "translatable.gb.name"  => "required|string|min:3",
            "translatable.gb.description"  => "required|string|min:3"
        ];
    }

    public function messages()
    {
        return [
            'icon.required' => 'A Icon is required',
            'translatable.gb.name.required'  => 'A name is required',
            'translatable.gb.description.required'  => 'A description is required',
        ];
    }
}
