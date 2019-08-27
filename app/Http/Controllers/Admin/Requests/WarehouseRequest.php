<?php

namespace App\Http\Controllers\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class RegionsRequest
 * @package App\Http\Controllers\Admin\Requests
 */
class WarehouseRequest extends FormRequest
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
            "translatable.gb.name"  => "required|string|min:1",
            "translatable.gb.description"  => "required|string",
            "translatable.gb.address"  => "required|string",
            "image"  => "required",
        ];
    }



    public function messages()
    {
        return [
            'translatable.gb.name.required'  => 'Name is required',
            'translatable.gb.description.required'  => 'Description is required',
            'translatable.gb.address.required'  => 'Address is required'
        ];
    }
}
