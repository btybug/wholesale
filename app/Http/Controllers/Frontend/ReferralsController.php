<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 2/5/2019
 * Time: 3:35 PM
 */

namespace App\Http\Controllers\Frontend;


use App\Events\NewReferral;
use App\Events\ReferralBonus;
use App\Http\Controllers\Controller;
use App\Models\MailJob;
use App\Services\UserService;
use App\User;
use Illuminate\Http\Request;

class ReferralsController extends Controller
{
    protected $view = 'frontend.my_account';

    public function getIndex()
    {
        $user = \Auth::user();
        return $this->view('referrals', compact('user'));
    }

    public function postReferredBy(Request $request)
    {
        $user = \Auth::user();
        if ($user->orders()->count()) return abort(404);
        $data = $request->all();
        $v = \Validator::make($data, ['referred_by' => 'required|exists_except:users,customer_number,id,' . $user->id]);
        if ($v->fails()) {
            return redirect()->back()->withInput()->withErrors($v);
        }
        $inviter = User::where('customer_number', $data['referred_by'])->first();
        $user->referred_by = $data['referred_by'];
        $user->save();
        $bonus = $inviter->bonus_bringers()->attach($user->id, ['type' => 'referral', 'status' => 0,'created_at' => date('Y-m-d h:i:s'),'updated_at'=>date('Y-m-d h:i:s')]);
        event(new NewReferral($inviter, $user));
        $user->bonus_bringers()->attach($inviter->id, ['type' => 'invited', 'status' => 0]);
        return redirect()->back();

    }

    public function getClaimBonus($id)
    {
        $user = \Auth::user();
        $referal_bonus = $user->referralBonus()->findOrFail($id);
        if (!$referal_bonus->status) {

            $userService = new UserService();
            $user_id = $user->id; //parent ID na
            $referal_id = $referal_bonus->bonus_bringing_user_id; //Referal ID na
            $result = $userService->giveCoupon($user_id, $referal_id);
            if ($result) {
                $referal_bonus->status = 1;
                $referal_bonus->referral_coupon_id = $result->id;
                $referal_bonus->save();
                event(new ReferralBonus($user, User::find($referal_id), $result->coupon));
                return redirect()->back()->with(['alert' => ['message' => 'Congratulations you get your Bonus ', 'class' => 'success']]);
            }
            return redirect()->back()->with(['alert' => ['message' => 'Something went wrong!  please try again or contact to support', 'class' => 'warning']]);
        }
        return redirect()->back()->with(['alert' => ['message' => 'this bonus already sorted', 'class' => 'danger']]);


    }
}