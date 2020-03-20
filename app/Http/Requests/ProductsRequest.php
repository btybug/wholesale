<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductsRequest extends FormRequest
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
            "translatable"    => "required|array|min:1",
            "translatable.gb.name"  => "required|string|min:3",
            "translatable.gb.slug"  => "required|string|min:3",
            "translatable.gb.short_description"  => "required|string|min:3",
            "translatable.gb.long_description"  => "required|string|min:3"
        ];
    }



    public function messages()
    {
        return [
            'slug.required' => 'A Slug is required',
            'translatable.gb.name.required'  => 'A Name is required',
            'translatable.gb.slug.required'  => 'Slug is required',
            'translatable.gb.short_description.required'  => 'A short description is required',
            'translatable.gb.long_description.required'  => 'A long description is required',
        ];
    }
}
