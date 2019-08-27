<?php

namespace App\Http\Controllers\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

/**
 * Class RegionsRequest
 * @package App\Http\Controllers\Admin\Requests
 */
class StaffRequest extends FormRequest
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
    public function rules(Request $request)
    {
        if($request->routeIs('admin_staff_new_post')){
            $rules = [
                'email'=>'required|email|unique:users,email',
            ];
        }else{
            $rules = [
                'email'=>'required|email|unique:users,email,'.$request->id,
            ];
        }

       return $rules + [
           'name'=>'required',
           'last_name'=>'required',
           'country'=>'required',
           'phone'=>'required|numeric',
           'gender'=>'required|in:male,female',
           'role_id'=>'required|exists:roles,id',
       ];
    }
}
