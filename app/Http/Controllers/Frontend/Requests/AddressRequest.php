<?php

namespace App\Http\Controllers\Frontend\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CompetitionRequest
 * @package App\Http\Controllers\Admin\Requests
 */
class AddressRequest extends FormRequest
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
            'company' => 'required|max:191',
            'first_line_address' => 'required|min:5|max:191',
            'second_line_address' => 'required|min:5|max:191',
            'city' => 'required|min:2|max:191',
            'country' => 'required|min:5|max:191',
            'post_code' => 'required|min:3|max:191',
            'type' => 'max:20',
        ];
    }
}