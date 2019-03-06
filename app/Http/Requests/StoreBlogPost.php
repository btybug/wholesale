<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogPost extends FormRequest
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
        $locale = app()->getLocale();
        return [
            'url' => 'required|unique:posts,id,'.$this->id,
            "translatable"    => "required|array|min:1",
            "translatable.gb.title"  => "required|string|min:3",
            "translatable.gb.short_description"  => "required|string|min:3",
            "translatable.gb.long_description"  => "required|string|min:3",
        ];
    }



    public function messages()
    {
        return [
            'url.required' => 'A URL is required',
            'translatable.gb.title.required'  => 'A title is required',
            'translatable.gb.short_description.required'  => 'A short description is required',
            'translatable.gb.long_description.required'  => 'A long description is required',
        ];
    }
}
