<?php

namespace App\Http\Controllers\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemsRequest extends FormRequest
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
            "barcode_id"  => "required",
            "image"  => "required",
            "default_price"  => "required",
//            "type"  => "required|in:simple,bundle",
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
