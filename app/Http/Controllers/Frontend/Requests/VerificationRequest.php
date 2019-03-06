<?php

namespace App\Http\Controllers\Frontend\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CompetitionRequest
 * @package App\Http\Controllers\Admin\Requests
 */
class VerificationRequest extends FormRequest
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
            'verification_type' => 'required|in:passport,driving_license,national_id',
            'verification_image' => 'required|image',
        ];
    }
}