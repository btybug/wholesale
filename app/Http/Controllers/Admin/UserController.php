<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 10/10/2018
 * Time: 4:24 PM
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Admin\Requests\AdminProfileRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddressesRequest;
use App\Models\Addresses;
use App\Models\Roles;
use App\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use PragmaRX\Countries\Package\Countries;
use App\Models\GeoZones;

class UserController extends Controller
{
         use SendsPasswordResetEmails;
    protected $redirectTo = '/home';

    protected $view = 'admin.users';

    private $geoZones;

    public function __construct(
        GeoZones $geoZones
    )
    {
        $this->geoZones = $geoZones;
    }


    public function index()
    {
        return $this->view('index');
    }

    public function showStaff()
    {
        return $this->view('staff');
    }

    public function newStaff(Countries $countries)
    {
        $countries = $countries->all()->pluck('name.common', 'name.common')->toArray();
        $roles = Roles::where('type', 'backend')->pluck('title', 'id')->toArray();
        return $this->view('staff.new', compact('countries', 'roles'));
    }
    //TODO create validation
    public function postStaff(Request $request)
    {
        $data = $request->except('_token');
        User::create($data);
        return redirect()->route('admin_staff');
    }

    public function edit(Request $request, Countries $countries)
    {
        $user = User::find($request->id);
        $countries = $countries->all()->pluck('name.common', 'name.common')->toArray();
        $roles = Roles::where('type', 'frontend')->pluck('title', 'id')->toArray();
        $billing_address = $user->addresses()->where('type', 'billing_address')->first();
        $default_shipping = $user->addresses()->where('type', 'default_shipping')->first();
        $address = $user->addresses()->where(function ($query){
           $query->where('type','address_book')->orWhere('type','default_shipping');
        })->pluck('first_line_address', 'id');
        $countriesShipping = [null => 'Select Country'] + $this->geoZones
                ->join('zone_countries', 'geo_zones.id', '=', 'zone_countries.geo_zone_id')
                ->select('zone_countries.*', 'zone_countries.name as country')
                ->groupBy('country')->pluck('country', 'id')->toArray();

//        dd();
        return $this->view('edit', compact('user', 'countries', 'roles','billing_address','default_shipping','address','countriesShipping'));
    }
    public function editStaff(Request $request, Countries $countries)
    {
        $user = User::find($request->id);
        $countries = $countries->all()->pluck('name.common', 'name.common')->toArray();
        $roles = Roles::where('type', 'backend')->pluck('title', 'id')->toArray();
        $billing_address = $user->addresses()->where('type', 'billing_address')->first();
        $default_shipping = $user->addresses()->where('type', 'default_shipping')->first();
        $address = $user->addresses()->where(function ($query){
           $query->where('type','address_book')->orWhere('type','default_shipping');
        })->pluck('first_line_address', 'id');
        $countriesShipping = [null => 'Select Country'] + $this->geoZones
                ->join('zone_countries', 'geo_zones.id', '=', 'zone_countries.geo_zone_id')
                ->select('zone_countries.*', 'zone_countries.name as country')
                ->groupBy('country')->pluck('country', 'id')->toArray();

        return $this->view('staff.edit', compact('user', 'countries', 'roles','billing_address','default_shipping','address','countriesShipping'));
    }

    public function postEditStaff($id,AdminProfileRequest $request)
    {
        $user = User::findOrFail($id);

        $user->update($request->except('_token'));

        return redirect()->back()->with('message',"Profile Updated successfully");
    }

    public function postAddressBookForm(Request $request)
    {
        $user = User::find($request->user_id);
        $id = $request->get('id', 0);
        $default = $request->get('default', false);

        $address_book = $user->addresses()->find($id);
        $countriesShipping = [null => 'Select Country'] + $this->geoZones
                ->join('zone_countries', 'geo_zones.id', '=', 'zone_countries.geo_zone_id')
                ->select('zone_countries.*', 'zone_countries.name as country')
                ->groupBy('country')->pluck('country', 'id')->toArray();

        $html = $this->view('_partials.new_address', compact(['address_book', 'countriesShipping', 'default']))->render();

        return \Response::json(['error' => false, 'html' => $html]);
    }

    public function postAddressBookSave(AddressesRequest $request)
    {
        $user = User::find($request->user_id);
        $data = $request->except('_token');
        if ($request->get('make_default')) {
            $data['type'] = 'default_shipping';
            $user->addresses()->where('type', 'default_shipping')->update(['type' => 'address_book']);
        }
        $address = Addresses::updateOrCreate(['id' => $request->get('id', null), 'user_id' => $data['user_id']], $data);

        return \Response::json(['error' => false, 'data' => $address]);
    }

    public function postAddress(AddressesRequest $request)
    {
        $data = $request->except('_token');
        Addresses::updateOrCreate(['id' => $request->get('id', null), 'user_id' => $data['user_id']], $data);
        return redirect()->back();
    }

    public function postEdit(Request $request)
    {
        $data = $request->except('_token');
        User::find($request->id)->update($data);

        return redirect()->back();
    }


    public function getUserActivity($id)
    {
        $user = User::findOrFail($id);
        return $this->view('activity_log', compact('user'));
    }

    protected function sendResetResponse(Request $request, $response)
    {
        return redirect()->back()
            ->with('status', trans($response));
    }

    public function postReject(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        if($user->email_verified_at && ! $user->status) {
            $user->update([
                'verification_type' => null,
                'verification_image' => null
            ]);
            return \Response::json(['error' => false]);
        }

        abort(404);
    }

    public function postApprove(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        if($user->email_verified_at && ! $user->status) {
            $user->update([
                'status' => true
            ]);

            return \Response::json(['error' => false]);
        }

        abort(404);
    }

    public function deleteStaff(Request $request)
    {
        $user = User::findOrFail($request->slug);
        $user->delete();

        return response()->json(['error' => false]);
    }

    public function delete(Request $request)
    {
        $user = User::findOrFail($request->slug);
        $user->delete();

        return response()->json(['error' => false]);
    }
}
