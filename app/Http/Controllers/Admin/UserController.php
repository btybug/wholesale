<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 10/10/2018
 * Time: 4:24 PM
 */

namespace App\Http\Controllers\Admin;


use App\Enums\ReviewStatusTypes;
use App\Http\Controllers\Admin\Requests\AdminProfileRequest;
use App\Http\Controllers\Admin\Requests\StaffRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddressesRequest;
use App\Models\Addresses;
use App\Models\GeoZones;
use App\Models\Review;
use App\Models\Roles;
use App\Models\UserNotes;
use App\Rules\MatchOldPassword;
use App\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PragmaRX\Countries\Package\Countries;

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

    public function getNew(Countries $countries)
    {
        $countries = $countries->all()->pluck('name.common', 'name.common')->toArray();
        $roles = Roles::where('type', 'frontend')->pluck('title', 'id')->toArray();
        return $this->view('new', compact('countries', 'roles'));
    }

    public function postNew(StaffRequest $request)
    {
        $data = $request->except('_token');
        $data['customer_number'] = generate_number("AMC");
        User::create($data);
        return redirect()->route('admin_customers');
    }


    public function showStaff()
    {
        return $this->view('staff');
    }


    public function newStaff(Countries $countries)
    {
        $countries = $countries->all()->pluck('name.common', 'name.common')->toArray();
        $roles = Roles::where('type', 'backend')
            ->where('slug','!=','superadmin')
            ->pluck('title', 'id')
            ->toArray();
        return $this->view('staff.new', compact('countries', 'roles'));
    }

    public function postStaff(StaffRequest $request)
    {
        $data = $request->except('_token');
        $data['customer_number'] = generate_number("AMC");
        $data['password']=Hash::make($request->password);
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
        $address = $user->addresses()->where(function ($query) {
            $query->where('type', 'address_book')->orWhere('type', 'default_shipping');
        })->pluck('first_line_address', 'id');
        $countriesShipping = [null => 'Select Country'] + $this->geoZones
                ->join('zone_countries', 'geo_zones.id', '=', 'zone_countries.geo_zone_id')
                ->select('zone_countries.*', 'zone_countries.name as country')
                ->groupBy('country')->pluck('country', 'id')->toArray();

        return $this->view('edit', compact('user', 'countries', 'roles', 'billing_address', 'default_shipping', 'address', 'countriesShipping'));
    }

    public function editStaff(Request $request, Countries $countries)
    {
        $user = User::find($request->id);
        if ($user->role->slug == 'superadmin') abort(403);
        $countries = $countries->all()->pluck('name.common', 'name.common')->toArray();
        $roles = Roles::where('type', 'backend')->where('slug', '!=', 'superadmin')->pluck('title', 'id')->toArray();
        $billing_address = $user->addresses()->where('type', 'billing_address')->first();
        $default_shipping = $user->addresses()->where('type', 'default_shipping')->first();
        $address = $user->addresses()->where(function ($query) {
            $query->where('type', 'address_book')->orWhere('type', 'default_shipping');
        })->pluck('first_line_address', 'id');
        $countriesShipping = [null => 'Select Country'] + $this->geoZones
                ->join('zone_countries', 'geo_zones.id', '=', 'zone_countries.geo_zone_id')
                ->select('zone_countries.*', 'zone_countries.name as country')
                ->groupBy('country')->pluck('country', 'id')->toArray();

        return $this->view('staff.edit', compact('user', 'countries', 'roles', 'billing_address', 'default_shipping', 'address', 'countriesShipping'));
    }

    public function postEditStaff($id, StaffRequest $request)
    {
        $user = User::findOrFail($id);
        if ($user->role->slug == 'superadmin') abort(403);
        $user->update($request->except('_token'));

        return redirect()->back()->with('message', "Profile Updated successfully");
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
        User::findOrFail($request->get('id'))->update(['password' => Hash::make($request->new_password)]);
        return redirect()->back()->with(['message' => 'Password change successfully.']);
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

    public function getUserVerify($id)
    {
        $user = User::findOrFail($id);
        $user->markEmailAsVerified();
        return redirect()->back();
    }

    protected function sendResetResponse(Request $request, $response)
    {
        return redirect()->back()
            ->with('status', trans($response));
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

    public function postNoteForm(Request $request)
    {
        $model = UserNotes::find($request->id);
        $html = view("admin.users._partials.new_note", compact(['model']))->render();

        return response()->json(['error' => false, 'html' => $html]);
    }

    public function postSaveNote(Request $request)
    {
        $note = UserNotes::find($request->id);
        if ($note) {
            $note->update($request->except('_token', 'id'));
        } else {
            $data = $request->except('_token');
            $data['author_id'] = \Auth::id();
            $note = UserNotes::create($data);
        }

        $html = view('admin.users._partials.user_notes')->with('user', $note->user)->render();
        return response()->json(['error' => false, 'html' => $html]);
    }

    public function postDeleteNote(Request $request)
    {
        $note = UserNotes::findOrFail($request->slug);
        $note->delete();

        return response()->json(['error' => false]);
    }

    public function postVerify(Request $request)
    {
        $user = User::findOrFail($request->id);
        if (!$user->email_verified_at) {
            $user->markEmailAsVerified();
            $user->update([
                'status' => true
            ]);

            return redirect()->back();
        }

        abort(404);
    }

    public function postRejectVerified(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->update([
            'status' => false
        ]);
        return redirect()->back();
    }

    public function getApproveReview($id)
    {
        $review = Review::findOrFail($id);
        $review->update([
            'status' => ReviewStatusTypes::PUBLISHED
        ]);
        return redirect()->back();
    }

    public function getDisableReview($id)
    {
        $review = Review::findOrFail($id);
        $review->update([
            'status' => ReviewStatusTypes::BLOCKED
        ]);
        return redirect()->back();
    }

    public function getAllowEditReview($id)
    {
        $review = Review::findOrFail($id);
        $review->update([
            'status' => ReviewStatusTypes::ALLOW_EDIT
        ]);
        return redirect()->back();
    }

    public function postApprove(Request $request)
    {
        $user = User::findOrFail($request->id);
        if (!$user->wholesaler_status) {
            $user->update([
                'wholesaler_status' => true
            ]);

            return redirect()->back();
        }

        abort(404);
    }

    public function postRejectApproved(Request $request)
    {
        $user = User::findOrFail($request->id);
        if ($user->wholesaler_status) {
            $user->update([
                'wholesaler_status' => false

            ]);
            return redirect()->back();
        }

        abort(404);
    }
}
