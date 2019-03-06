<?php

namespace App\Http\Controllers\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class RegionsRequest
 * @package App\Http\Controllers\Admin\Requests
 */
class AccountsRequest extends FormRequest
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
           'old.*.email'=>'required|email',
           'new.*.email'=>'required|email',
           'new_to.*.email'=>'required|email'
       ];
    }
}