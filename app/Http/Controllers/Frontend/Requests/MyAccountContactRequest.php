<?php

namespace App\Http\Controllers\Frontend\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CompetitionRequest
 * @package App\Http\Controllers\Admin\Requests
 */
class MyAccountContactRequest extends FormRequest
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
            'phone' => 'required|regex:/[0-9]{9}/|unique:users,phone,'.\Auth::id(),
            'email' => 'required|string|email|max:255|unique:users,email,'.\Auth::id()
        ];
    }
}