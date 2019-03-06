<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 2/11/2019
 * Time: 9:56 AM
 */

namespace App\Services;


use App\Models\Orders;
use App\User;
use Carbon\Carbon;
use PragmaRX\Countries\Package\Countries;

class Widgets
{
    public function userRegistrations()
    {
        return User::whereDate('created_at', '>=', Carbon::now()->startOfWeek()->toDateString())->count();
    }

    public function newOrders()
    {
        return Orders::whereDate('created_at', '>=', Carbon::now()->startOfWeek()->toDateString())->count();
    }

    public function map()
    {
        $countries = (new Countries)->all()->pluck('cca2', 'cca3');
        $users = User::leftJoin('roles', 'users.role_id', '=', 'roles.id')->where('roles.slug', 'customer')
            ->select('country', \DB::raw('count(*) as total'))
            ->groupBy('country')->get()
            ->pluck('total', 'country');
        $result = [];
        foreach ($users as $key => $user) {
            if (isset($countries[$key])) {
                $result[$countries[$key]] = $user;
            }
        }
        return json_encode($result);
    }

    public function quickEmailSend($request)
    {

        return \Mail::send('admin.widgets.mail', ['data' => $request->all()], function ($message) use ($request) {
            $message->to($request->get('emailto'));
        });
    }
}