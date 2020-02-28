<?php


namespace App\Http\Controllers\Admin\App\Customers;


use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\ProfileRequest;

class ProfileController extends Controller
{
    public function index()
    {
        $user = \Auth::user();
        return view('customers.profile.profile', compact('user'));
    }

    public function edit(ProfileRequest $request)
    {
        \Auth::user()->update($request->except('_token'));
        return redirect()->back();
    }

    public function getPassword()
    {
        return view('customers.profile.password');
    }

    public function postPassword(PasswordRequest $request)
    {
        $user = \Auth::getUser();
        $user->password=\Hash::make($request->get('password'));
        $user->save();
        return redirect()->back()->with(['message'=>'Password was changed ']);
    }
}
