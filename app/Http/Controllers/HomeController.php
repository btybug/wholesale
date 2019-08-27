<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Settings;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public $settings;

    public function __construct(Settings $settings)
    {
        $this->settings = $settings;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = $this->settings->getEditableData('banners');
        $banners = ($banners->data) ? json_decode($banners->data, true) : [];
        $categories = Category::where('type', 'stocks')->whereNull('parent_id')->get();

        return view('welcome', compact(['banners','categories']));
    }

    public function getFaq()
    {
        return view('faq');
    }

    public function verifyWholesaler(){
        return view('auth.verify_wholesaler');
    }
}
