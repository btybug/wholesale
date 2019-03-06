<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 11/26/2018
 * Time: 10:34 AM
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Admin\Requests\ChannelsRequest;
use App\Http\Controllers\Controller;
use App\Models\ChannelUserPermissions;
use App\Models\Client;
use App\Models\Roles;
use App\Models\Statuses;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Passport\Passport;
use PragmaRX\Countries\Package\Countries;

class SaleChannelsController extends Controller
{
    protected $view = 'admin.items.sale_channels';


    public function getSaleChannels()
    {

        return $this->view('index');
    }


    public function postSaleChannels(ChannelsRequest $request)
    {
        $user = User::create([
            'name' => Str::random(8),
            'last_name' => Str::random(8),
            'email' => $request->get('email'),
            'phone' => rand(100000000, 999999999),
            'country' => $request->get('country'),
            'gender' => 'male',
            'status' => 1,
            'role_id' => Roles::where('slug', 'channel')->first()->id,
            'password' => \Hash::make($request->get('password')),
        ]);
        $userId = $request->user()->getKey();
        $name = $request->get('name');
        $client = Passport::client()->forceFill([
            'user_id' => $userId,
            'channel_user_id' => $user->id,
            'name' => $name,
            'secret' => str_random(40),
            'redirect' => 'http://localhost',
            'url' => $request->get('url'),
            'description' => $request->get('description'),
            'icon' => $request->get('icon'),
            'personal_access_client' => 0,
            'password_client' => 1,
            'revoked' => false,
        ]);
        $client->save();
        return redirect()->route('admin_sale_channels');
    }

    public function getCreateChannel(Countries $countries)
    {
        $countries = $countries->all()->pluck('name.common', 'name.common')->toArray();
        return $this->view('create', compact('countries'));
    }

    public function getSaleChannelSettings($id)
    {
        $groups=Statuses::where('type','groups')->get()->pluck('name','name');
        $channel = Client::findOrFail($id);
        $stocks=$channel->settings('stocks');
        $products=$channel->settings('products');
        $customers=$channel->settings('customers');
        $orders=$channel->settings('orders');
        return $this->view('settings', compact('channel','stocks','products','groups','customers','orders'));
    }
    public function postSaleChannelSettings(Request $request)
    {
        $id = $request->id;
        $channel = Client::findOrFail($id);
        $channel->name=$request->get('name');
        $channel->description=$request->get('description');
        $user_id = $channel->channel_user_id;
        $permissions = $request->get('permissions', []);
        $filters = $request->get('filters', []);
        foreach ($permissions as $route => $lvl) {
            $data[] = [
                'route' => $route,
                'lvl' => $lvl,
                'channel_user_id' => $user_id,
                'filter' => (isset($filters[$route])) ? json_encode($filters[$route], true) : null,
                'created_at'=>date('Y-m-d h:i:s'),
                'updated_at'=>date('Y-m-d h:i:s'),
                ];
        }
        ChannelUserPermissions::where('channel_user_id',$user_id)->delete();
        \DB::table('channel_user_permissions')->insert($data);
        $channel->save();
        return redirect()->back();
    }

    public function getCustomers($id)
    {
        $user=User::findOrFail($id);
        return $this->view('customers',compact('id','user'));
    }
}