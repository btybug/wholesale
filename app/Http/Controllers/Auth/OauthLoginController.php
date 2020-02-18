<?php


namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Services\WholesaleService;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Str;

class OauthLoginController extends Controller
{
    protected $wholesaleService;

    public function __construct(WholesaleService $wholesaleService)
    {
        $this->wholesaleService = $wholesaleService;
    }

    public function gatCode(Request $request)
    {
        return redirect($this->wholesaleService->code($request));
    }

    public function Callback(Request $request)
    {
        $response = $this->wholesaleService->getAccessToken($request);
        return $this->getUser($response);
    }


    private function getUser($response)
    {
        return $this->loginOrNewUser($this->wholesaleService->getUser($response), $response);

    }

    private function loginOrNewUser(array $client, $response)
    {
        $user = User::where('email', $client['user']['email'])->first();

        ($user) ? $this->login($user,$response) : \Auth::login($this->newUser($client, $response));
        return redirect()->route('admin_dashboard');

    }

    protected function login($user, $response)
    {
        $this->wholesaleService->updateToken($response,$user);
        \Auth::login($user);
    }

    protected function newUser($data, $response)
    {
        $wholesaler = $data['user'];
        $user = User::create([
            'name' => $wholesaler['name'],
            'last_name' => $wholesaler['last_name'],
            'email' => $wholesaler['email'],
            'role_id' => 1,
            'dob' => $wholesaler['dob'],
            'customer_number' => uniqid(),

            'password' => \Hash::make(\Illuminate\Support\Str::random(8)),
        ]);
//        $shop=$user->makeDefaultStorage($data['user']);
//        $shop->racks()->create(['name' => 'Main', 'slug' => 'main', 'is_default' => 1, 'description' => 'sale is possible only from this rack']);
//
        $user->wholesaleToken()->create($response);
        return $user;
    }

}
