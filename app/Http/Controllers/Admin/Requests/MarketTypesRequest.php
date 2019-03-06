<?php

namespace App\Http\Controllers\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class RegionsRequest
 * @package App\Http\Controllers\Admin\Requests
 */
class MarketTypesRequest extends FormRequest
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
                        'name' => 'required',
                        'sport_id' => 'required|exists:sports,id'
                    ];
                }
            case 'PUT':
            case 'PATCH':
                {
                    $id = $this->route('id');
                    return [
                        'id' => 'required|exists:market_type,id',
                        'name' => 'required',
                    ];
                }
            default:
                break;
        }
        return [];
    }
}