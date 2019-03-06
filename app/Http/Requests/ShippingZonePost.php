<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShippingZonePost extends FormRequest
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
            'name' => 'required',
            "description"    => "required|string|min:3",
            "tax"    => "integer",
            "country"  => "required|string|min:3",
        ];
    }



    public function messages()
    {
        return [
            'name.required' => 'A name is required',
            'description.required'  => 'A description is required',
            'tax.integer' => 'Ilease input iteger Tax value',
            'country.required'  => 'A country is required',
        ];
    }
}
