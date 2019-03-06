<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponsRequest extends FormRequest
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
            "code"    => "required|string|min:3|unique:coupons,code,".$this->id,
            "type"    => "required",
            "discount"  => "required|integer",
            "total_amount"  => "required|integer",
            "shipping_type"  => "required|string"
        ];
    }



    public function messages()
    {
        return [
            'name.required' => 'A name is required',
            'code.required'  => 'A code is required',
            'type.required' => 'A type is required',
            'discount.required'  => 'A discount is required',
            'total amount.required'  => 'A total amount is required',
            'shipping_type.required'  => 'A shipping type is required',
            'status.required'  => 'A status is required',
        ];
    }
}
