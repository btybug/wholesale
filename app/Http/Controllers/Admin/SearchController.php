<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 31.12.2017
 * Time: 00:15
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\User;
use App\UserSearch\UserSearch;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function filter(Request $request)
    {
        return UserSearch::apply($request,true);
    }
}