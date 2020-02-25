<?php


namespace App\Services;


use GuzzleHttp\Client as Http;
use Illuminate\Http\Request;
use InvalidArgumentException;
use Str;

class WholesaleService
{
    protected $http;
    protected $access_token;
    protected $user;

    public function __construct(Http $http)
    {
        $this->http = $http;
        $this->access_token = (\Auth::check()) ? \Auth::user()->wholesaleToken : null;
        $this->user = \Auth::user();
    }

    public function code(Request $request)
    {
        $request->session()->put('state', $state = \Illuminate\Support\Str::random(40));

        $query = [
            'client_id' => env('WHOLESALER_ID'),
            'redirect_uri' => url('callback'),
            'response_type' => 'code',
            'scope' => '',
            'state' => $state,
        ];
        return $this->url('/oauth/authorize', $query);
    }

    public function getAccessToken(Request $request)
    {
        $state = $request->session()->pull('state');

        throw_unless(
            strlen($state) > 0 && $state === $request->state,
            InvalidArgumentException::class
        );

        $response = $this->http->post($this->url('/oauth/token'), [
            'form_params' => [
                'grant_type' => 'authorization_code',
                'redirect_uri' => url('callback'),
                'client_id' => env('WHOLESALER_ID'),
                'client_secret' => env('WHOLESALER_SECRET'),
                'code' => $request->code,
            ],
        ]);
        return json_decode((string)$response->getBody(), true);
    }

    public function getUser($accessToken)
    {
        $response = $this->http->get($this->url('/api/user'), [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $accessToken['access_token'],
            ],
        ]);
        return json_decode((string)$response->getBody(), true);
    }

    public function getOrders()
    {
        $response = $this->http->get($this->url('/api/get-orders'), [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $this->getFreshToken(),
            ],
        ]);
        return json_decode((string)$response->getBody(), true);
    }

    public function getOrdersAndItems()
    {
        $response = $this->http->get($this->url('/api/get-orders-and-items'), [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $this->getFreshToken(),
            ],
        ]);
        return json_decode((string)$response->getBody(), true);
    }

    public function postImport($id)
    {
        $response = $this->http->post($this->url('/api/post-import'), [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $this->getFreshToken(),
            ],
            'form_params' => [
                'item_id' => $id
            ],

        ]);
        return json_decode((string)$response->getBody(), true);
    }

    public function getItems($ides)
    {
        $response = $this->http->post($this->url('/api/post-items'), [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $this->getFreshToken(),
            ],
            'form_params' => [
                'ides' => $ides
            ],

        ]);
        return json_decode((string)$response->getBody(), true);
    }
    public function getAllItems()
    {
        $response = $this->http->post($this->url('/api/post-all-items'), [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $this->getFreshToken(),
            ]
        ]);
        return json_decode((string)$response->getBody(), true);
    }

    public function getCategories()
    {
        $response = $this->http->get($this->url('/api/get-categories'), [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $this->getFreshToken(),
            ]
        ]);
        return json_decode((string)$response->getBody(), true);
    }

    public function getItem($id)
    {
        $response = $this->http->post($this->url('/api/post-item'), [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $this->getFreshToken(),
            ],
            'form_params' => [
                'id' => $id
            ],

        ]);
        return json_decode((string)$response->getBody(), true);
    }

    public function getOrderItems($id)
    {
        $response = $this->http->get($this->url('/api/get-order-items', ['item_id' => $id]), [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $this->getFreshToken()

            ],
        ]);
        return json_decode((string)$response->getBody(), true);
    }

    private function url($path, $param = null)
    {
        return env('WHOLESALER_URL') . '/' . trim($path, '/') . (($param) ? '?' . http_build_query($param) : '');
    }

    public function updateToken($response, $user = null)
    {
        if ($user) $this->user = $user;
        ($this->user->wholesaleToken()->exists()) ? $this->user->wholesaleToken->update($response) : $this->user->wholesaleToken()->create($response);
        return $response['access_token'];
    }

    public function getFreshToken()
    {
        if ((time() >= \Carbon\Carbon::parse($this->access_token->updated_at)->timestamp + $this->access_token->expires_in)) {
            return $this->updateToken($this->refresh_token());
        }
        return $this->access_token->access_token;
    }

    public function refresh_token()
    {
        $response = $this->http->post($this->url('/oauth/token'), [
            'form_params' => [
                'grant_type' => 'refresh_token',
                'refresh_token' => $this->access_token->refresh_token,
                'client_id' => env('WHOLESALER_ID'),
                'client_secret' => env('WHOLESALER_SECRET'),
                'scope' => '',
            ],
        ]);

        return json_decode((string)$response->getBody(), true);
    }


}
