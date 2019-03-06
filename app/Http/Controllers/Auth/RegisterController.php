<?php

namespace App\Http\Controllers\Auth;

use App\Events\Registered;
use App\Models\Roles;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/my-account';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        abort(404);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'terms_conditions' => 'required|in:1',
            'name' => 'required|string|min:2|max:255',
            'last_name' => 'required|string|min:2|max:255',
            'phone' => 'required|unique:users|regex:/[0-9]{9}/',
            'email' => 'required|string|email|max:255|unique:users',
            'gender' => 'required|in:male,female',
            'country' => 'required',
            'password' => 'required|string|min:6|confirmed',
            'g-recaptcha-response' => ['required', 'recaptcha']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $customer_number = get_customer_number();
        return User::create([
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'country' => $data['country'],
            'gender' => $data['gender'],
            'status' => 0,
            'role_id' => Roles::where('slug', 'customer')->first()->id,
            'customer_number' => $customer_number,
            'password' => Hash::make($data['password']),
        ]);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        return response()->json(['success' => true, 'redirectPath' => $this->redirectPath()]);
    }
}
