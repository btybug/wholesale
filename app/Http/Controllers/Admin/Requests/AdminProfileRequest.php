<?php

namespace App\Http\Controllers\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CompetitionRequest
 * @package App\Http\Controllers\Admin\Requests
 */
class AdminProfileRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'last_name' =>'required|string|max:255',
            'phone' => 'required|regex:/[0-9]{9}/|unique:users,phone,'.\Auth::id(),
            'email' => 'required|string|email|max:255|unique:users,email,'.\Auth::id(),
            'gender' => 'required|in:male,female',
            'country' => 'required',
        ];
    }
}