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
use App\Models\Attributes;
use App\Models\Category;
use App\Models\Common;
use App\Models\Newsletter;
use App\Models\SiteCurrencies;
use App\Models\Stickers;
use App\Models\Stock;
use App\ProductSearch\ProductSearch;
use App\User;
use Illuminate\Http\Request;

class OffersController extends Controller
{
    protected $view='frontend.offers';

    public function getIndex($slug = null)
    {
        $offers = Stock::where('is_offer',true)->where('offer_type',false)->get();

        return $this->view('index', compact('offers'));
    }

    public function postOffer(Request $request)
    {
        $current = Category::where('type', 'offers')->where('id',$request->id)->first();
        if($current){
            $html = view("frontend.offers._partials.current",compact('current'))->render();
            return response()->json(['error' => false,'html' => $html]);
        }

        return response()->json(['error' => true]);
    }
}
