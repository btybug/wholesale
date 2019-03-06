<?php

namespace App\Http\Controllers\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CompetitionRequest
 * @package App\Http\Controllers\Admin\Requests
 */
class MatchRequest extends FormRequest
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
        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
                {
                    return [];
                }
            case 'POST':
                {
                    return [
                        'sport_id' => 'required|exists:sports,id',
                        'competition_id' => 'required|exists:competitions,id',
                        't1_id' => 'required|exists:teams,id',
                        't2_id' => 'required|exists:teams,id',
                    ];
                }
            case 'PUT':
            case 'PATCH':
                {
                    $id = $this->route('id');
                    return [
                        'id' => 'required|exists:matches,id',
                        'sport_id' => 'required|exists:sports,id',
                        'competition_id' => 'required|exists:competitions,id',
                        't1_id' => 'required|exists:teams,id',
                        't2_id' => 'required|exists:teams,id',
                    ];
                }
            default:
                break;
        }
        return [];
    }
}