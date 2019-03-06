<?php

namespace App\Http\Controllers\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class RegionsRequest
 * @package App\Http\Controllers\Admin\Requests
 */
class MailTemplatesRequest extends FormRequest
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
            'from' => 'required|email',
            'is_active' => 'required|in:0,1',
            'translatable.gb.subject' => 'required',
            'translatable.gb.content' => 'required',
            'admin.from' => 'required|email',
            'admin.translatable.gb.subject' => 'required',
            'admin.translatable.gb.content' => 'required',
        ];
    }
}