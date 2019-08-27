<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactUsRequest;
use App\Models\Category;
use App\Models\Common;
use App\Models\ContactUs;
use App\Models\GeoZones;
use App\Models\Settings;
use App\Models\ZoneCountries;
use App\Services\ShortCodes;
use Illuminate\Http\Request;
use PragmaRX\Countries\Package\Countries;

class GuestController extends Controller
{
    protected $view = 'frontend.guest';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $countries;
    private $settings;

    public function __construct(Countries $countries,Settings $settings)
    {
        $this->countries = $countries;
        $this->settings = $settings;
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function getFaq()
    {
        $categories = Category::with('faqs')->where('type', 'faq')->whereNull('parent_id')->get();
        $category = $categories->first();

        return $this->view('faq', compact(['categories', 'category']));
    }

    public function getFaqByCategory(Request $request)
    {
        $category = Category::with('faqs')->where('type', 'faq')->where('id', $request->uid)->first();
        if ($category) {
            $html = $this->view('_partials.faq_questions', compact(['category']))->render();

            return \Response::json(['error' => false, 'html' => $html, 'count' => $category->faqs->count()]);
        }

        return \Response::json(['error' => true]);
    }

    public function getKnowledgeBase()
    {
        return $this->view('knowledge_base');
    }

    public function getManuals()
    {
        return $this->view('manuals');
    }

    public function getTicket()
    {
        return $this->view('ticket');
    }

    public function getTermsConditions()
    {
        $model = Common::where('type','tc')->first();

        return $this->view('terms_conditions',compact(['model']));
    }

    public function getDelivery(GeoZones $geoZones)
    {

        $countries = [null => 'Select Country'] + $geoZones
                ->join('zone_countries', 'geo_zones.id', '=', 'zone_countries.geo_zone_id')
                ->select('zone_countries.*', 'zone_countries.name as country')
                ->groupBy('country')->pluck('country', 'country')->toArray();
        return $this->view('delivery', compact('countries'));
    }

    public function getWholeSellers()
    {
        return $this->view('whole_sellers');
    }

    public function getCities(Request $request)
    {
        $zones = GeoZones::join('zone_countries', 'geo_zones.id', '=', 'zone_countries.geo_zone_id')
            ->select('zone_countries.*', 'zone_countries.name as country')
            ->orderBy('name');
        return ['error' => false, 'html' => \View::make($this->view . '._partials,regions')];
    }

    public function getDeliveryPrices(Request $request)
    {

    }

    public function getRegionsByCountry(Request $request)
    {
        if (!$request->country) return ['error' => true];

        $data = $this->countries->where('name.common', $request->country)->first()->hydrateStates()->states->pluck('name', 'name')->toArray();
        return ['error' => false, 'data' => $data];
    }

    public function getRegionsByGeoZone(Request $request)
    {
        $country = ZoneCountries::find($request->get('country', 0));
        if (!$request->country) return ['error' => true];

        $data = $country->regions->pluck('name', 'id');
        if ($data)
            return ['error' => false, 'data' => $data];
    }

    public function getContactUs()
    {
        $settings = $this->settings->getEditableData('admin_general_settings');

        return $this->view('contact_us',compact(['settings']));
    }

    public function postContactUs(ContactUsRequest $request)
    {

        $data = $request->all();
//        try{
        $result = [
            'name' => trim(htmlspecialchars($data['name'])),
            'phone' => isset($data['phone']) ? trim(htmlspecialchars($data['phone'])) : null,
            'category' => trim(htmlspecialchars($data['category'])),
            'email' => $data['email'],
            'uniq_id' => uniqid($data['category'] . "_"),
            'message' => trim(htmlspecialchars($data['message'])),
        ];
//            $mail=Gmail::message()->subject('about_team_5c4ef6c1e44b1')->preload()->all();

        $email =  $contact_us=\App\Models\ContactUs::create($result);
        event(new \App\Events\ContactUs($email));
        $email->save();
//        \Config::set('mail.from.address',$data['email']);
//        \Mail::to(Gmail::user())->send($email);
//        \Mail::to('hakobyan.sahak88@gmail.com')->send($email);
//        $result['message']=Gmail::getEncodedBody($result['message']);
//        $contact_us=\App\Models\ContactUs::create($result);
//        $contact_us->recipients()->create(['name'=>env('APP_NAME'),'email'=>Gmail::user()]);
//        }catch (\Exception $exception){
//            \Log::emergency("message: " . $exception->getMessage(). "  --file-  line : " . $exception->getFile(). ' - ' .$exception->getLine());
//        }

        return redirect()->back();
    }
}
