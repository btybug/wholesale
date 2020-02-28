<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 10/23/2018
 * Time: 10:46 AM
 */

namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;
use App\Http\Requests\SubscribeRequest;
use App\Models\Category;
use App\Models\Common;
use App\Models\Newsletter;
use App\Models\SiteCurrencies;
use App\User;
use Illuminate\Http\Request;

class CommonController extends Controller
{
    protected $view='frontend.common';

    public function getSales()
    {
        return $this->view('sale');
    }

    public function getForum()
    {
        return $this->view('forum');
    }
    public function getSupport()
    {
        return $this->view('support');
    }
    public function getContactUs()
    {
        $model = Common::where('type','tc')->first();

        return $this->view('contact_us',compact(['model']));
    }
    public function getAboutUs()
    {
        $model = Common::where('type','about_us')->first();

        return $this->view('about_us',compact(['model']));
    }

    public function getPrivacy()
    {
        $model = Common::where('type','privacy')->first();

        return $this->view('privacy',compact(['model']));
    }

    public function getCookies()
    {
        $model = Common::where('type','cookies')->first();

        return $this->view('cookies',compact(['model']));
    }

    public function changeCurrency(Request $request,SiteCurrencies $siteCurrencies)
    {
        $currency = $siteCurrencies->where('code',$request->code)->first();

        if ($currency) {
            \Cookie::queue('currency', $request->code);
        }

        return $request->code;
    }

    public function postSubscribe(SubscribeRequest $request)
    {
        $email = $request->get('subscribe_email');
        $user = User::where('email',$email)->first();
        $newsletter = Category::where('type','notifications')->where('slug','newsletter')->first();
        Newsletter::create([
           'email' => $email,
           'category_id' => $newsletter->id,
            'user_id' => ($user) ? $user->id : null
        ]);

        return redirect()->back()->with('message','You have successfully subscribed to newsletter');
    }
}
