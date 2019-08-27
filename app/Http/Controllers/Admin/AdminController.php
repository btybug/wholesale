<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 31.12.2017
 * Time: 00:15
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Admin\Requests\AdminProfileRequest;
use App\Http\Controllers\Admin\Requests\UserAvaratRequest;
use App\Http\Controllers\Controller;
use App\Models\Dashboard;
use App\Models\Roles;
use App\Services\ManagerApiRequest;
use App\Services\UserService;
use App\Services\Widgets;
use App\User;
use PragmaRX\Countries\Package\Countries;
use App\Models\GeoZones;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private $geoZones;

    public function __construct(
        GeoZones $geoZones
    )
    {
        $this->geoZones = $geoZones;
    }

    public function getDashboard()
    {
        $widgets = \Auth::user()->widgets()->pluck('widget')->all();

        return view('admin.dashboard', compact(['widgets']));
    }

    public function find()
    {
        return view('admin.find', compact([]));
    }

    public function saveDashboardWidgets(Request $request)
    {
        $placeholderItems = Dashboard::where('placeholder', $request->placeholder)->where('user_id', \Auth::id())->get();
        $widgets = ($request->get('widgets')) ? explode(',', $request->get('widgets')) : [];

        if (count($widgets)) {
            foreach ($widgets as $position => $widget) {
                $widgetInPlacholder = Dashboard::where('placeholder', $request->placeholder)->where('user_id', \Auth::id())->where('widget', $widget)->first();
                if ($widgetInPlacholder) {
                    $widgetInPlacholder->update([
                        'position' => $position
                    ]);
                } else {
                    Dashboard::where('user_id', \Auth::id())->where('widget', $widget)->delete();
                    Dashboard::create([
                        'user_id' => \Auth::id(),
                        'placeholder' => $request->placeholder,
                        'position' => $position,
                        'widget' => $widget
                    ]);
                }
            }
        }

        return \Response::json(['error' => false]);
    }

    public function deleteDashboardWidget(Request $request)
    {
        $widgetInPlacholder = \Auth::user()->widgets()->where('placeholder', $request->placeholder)->where('widget', $request->key)->first();
        if ($widgetInPlacholder) {
            $widgetInPlacholder->delete();
            return \Response::json(['error' => false]);

        }
        return \Response::json(['error' => true]);
    }

    public function getProfile(Request $request, Countries $countries)
    {
        $user = \Auth::user();
        $countries = $countries->all()->pluck('name.common', 'name.common')->toArray();

        return view('admin.dashboard_profile', compact('user', 'countries'));
    }

    public function postProfileImageUpload(UserAvaratRequest $request, UserService $userService)
    {
        $result = $userService->avatarUpload($request->except('_token'));
        return response()->json($result);
    }

    public function postProfile(AdminProfileRequest $request)
    {
        $data = $request->except(['_token', 'avatar']);
        $user = \Auth::user();
        $user->update($data);

        return redirect()->back()->with('message', 'Your profile updated');
    }

    public function test()
    {
        return view('test');
        //ManagerApiRequest $request
       // dd($request->exportOrder(8));
    }

    public function getPassport()
    {
        return view('admin.passport');
    }

    public function roles()
    {
        return view('');
    }

    public function quickEmail(Request $request, Widgets $widgets)
    {
        $widgets->quickEmailSend($request);
        return ['error' => false];
    }
}
