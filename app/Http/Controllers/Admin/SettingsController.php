<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 10/10/2018
 * Time: 4:24 PM
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Admin\Requests\AccountsRequest;
use App\Http\Controllers\Admin\Requests\GeoZonesRequest;
use App\Http\Controllers\Admin\Requests\MailTemplatesRequest;
use App\Http\Controllers\Controller;
use App\Models\Common;
use App\Models\Couriers;
use App\Models\Currencies;
use App\Models\DeliveryCostsTypes;
use App\Models\Emails;
use App\Models\FooterLinks;
use App\Models\GeoZones;
use App\Models\GetForexData;
use App\Models\Gmail;
use App\Models\Items;
use App\Models\Languages;
use App\Models\MailTemplates;
use App\Models\MainPagesSeo;
use App\Models\Products;
use App\Models\Settings;
use App\Models\ShippingZones;
use App\Models\SiteCurrencies;
use App\Models\SiteLanguages;
use App\Models\Statuses;
use App\Models\Stock;
use App\Models\TaxRates;
use App\Models\Translations\FooterLinkTranslation;
use App\Services\ShortCodes;
use Illuminate\Http\Request;
use PragmaRX\Countries\Package\Countries;
use Torann\GeoIP\GeoIP;

class SettingsController extends Controller
{
    protected $view = 'admin.settings';

    public function getLanguages()
    {
        $languages = SiteLanguages::all();
        return $this->view('languages', compact(['languages']));
    }


    public function setLanguageDefault(Request $request)
    {
        $lang_id = $request->language_id;
        SiteLanguages::where('default', '=', 1)->update(["default" => 0]);
        SiteLanguages::find($lang_id)->update(["default" => 1]);
    }


    public function getLanguagesNew()
    {
        $model = null;
        $countries = Languages::pluck('name', 'code')->all();

        return $this->view('new_languages', compact(['model', 'countries']));
    }

    public function getLanguagesEdit($id)
    {
        $model = SiteLanguages::findOrFail($id);
        $countries = Languages::pluck('name', 'code')->all();

        return $this->view('new_languages', compact(['model', 'countries']));
    }

    public function postLanguages(Request $request)
    {
        $language = SiteLanguages::updateOrCreate(['id' => $request->id], $request->except("_token"));

        return redirect()->route('admin_settings_languages');
    }

    public function getLanguageManager()
    {
        $languages = SiteLanguages::all();
        $keys = $languages->where('default', true)->first()->getTranslations();

        return $this->view('language_manager', compact(['languages', 'keys']));
    }

    public function postLanguageManager(Request $request)
    {
        $key = $request->name;
        $code = $request->pk;
        $value = $request->value;

        $data = json_decode(\File::get("resources/lang/$code.json"), true);
        $data[$key] = $value;
        \File::put("resources/lang/$code.json", json_encode($data));

        return \Response::json(['error' => false]);
    }

    public function getMailTemplates()
    {
        return $this->view('mail_templates');
    }


    public function postLanguageGetWithCode(Request $request)
    {
        $lang = Languages::where('code', $request->code)->first();
        if ($lang) {
            return \Response::json(['error' => false, 'data' => $lang]);
        }

        return \Response::json(['error' => true, 'message' => "Error"]);
    }

    public function getLanguagesDelete(Request $request, $id)
    {
        $lang = SiteLanguages::findOrFail($id);
        if ($lang && $lang->default == 0) {
            $lang->delete();
        }

        return redirect()->back();
    }

    public function getEmails()
    {
        return $this->view('emails.index');
    }


    public function getGeneral(Settings $settings, Countries $countries)
    {
        $model = $settings->getEditableData('admin_general_settings');

        $countries = [null => 'Select Country'] + $countries->all()->pluck('name.common', 'name.common')->toArray();
        return $this->view('general', compact('model', 'countries'));
    }
    public function saveGeneral(Request $request, Settings $settings)
    {
        $settings->updateOrCreateSettings('admin_general_settings', $request->except('_token'));
        return redirect()->back();
    }

    public function getDefaults(Settings $settings)
    {
        $model = $settings->getEditableData('admin_defaults_settings');
        return $this->view('defaults', compact('model'));
    }

    public function saveDefaults(Request $request, Settings $settings)
    {
        $settings->updateOrCreateSettings('admin_defaults_settings', $request->except('_token'));
        return redirect()->back();
    }

    public function getAccounts()
    {
//        $alians = getGoogleAlians();
        $froms = Emails::where('type', 'from')->get();
        $tos = Emails::where('type', 'to')->get();
        return $this->view('accounts', compact('froms', 'tos'));
    }

    public function postAccounts(AccountsRequest $request)
    {
        $new = $request->get('new', []);
        $new_to = $request->get('new_to', []);
        $olds = $request->get('old', []);
        if (count($olds)) {
            Emails::whereNotIn('id', array_keys($olds))->delete();
            foreach ($olds as $id => $old) {
                \DB::table('emails')->where('id', $id)->update($old);
            }
        }
        $data = array_merge($new, $new_to);
        if (count($data)) {
            \DB::table('emails')->insert($data);
        }
        return redirect()->back();
    }

    public function getRegions(SiteLanguages $languages, Settings $settings, Countries $countries)
    {
        $default = $settings->where('section', 'currencies')->where('key', 'default_currency_code')->first();
        $siteCurrencies = array_keys(($default) ? [$default->val => 1] + $settings->getEditableData('currencies', $default->val)->toArray() : []);
        $currencies = [];
        foreach ($siteCurrencies as $siteCurrency) {
            $currencies[$siteCurrency] = $siteCurrency;
        };
        $regions = $settings->where('section', 'site_regions')->where('key', 'regions')->first();
        $regions = ($regions) ? json_decode($regions->val, true) : [];
        $languages = $languages->all()->pluck('name', 'name');
        $countries = $countries->all()->pluck('name.common', 'name.common')->toArray();
        return $this->view('regions', compact('languages', 'currencies', 'regions', 'countries'));
    }

    public function postRegions(Request $request)
    {
        $data = $request->except('_token');
        Settings::updateOrCreate(['section' => 'site_regions', 'key' => 'regions'], ['val' => json_encode($data, true)]);
        return redirect()->back();
    }

    public function getFooter()
    {
        $links = FooterLinks::leftJoin('footer_links_translations', 'footer_links.id', '=', 'footer_links_translations.footer_links_id')
            ->whereNull('footer_links.parent_id')->select('footer_links.*', 'footer_links_translations.title', 'footer_links_translations.locale')
            ->with('children')->get()->toArray();
        $footer_links = [];
        foreach ($links as $footer_link) {
            $footer_links[$footer_link['locale']][] = $footer_link;
        }
        return $this->view('footer', compact('footer_links'));
    }

    public function postFooter(Request $request)
    {
        FooterLinkTranslation::truncate();
        FooterLinks::whereNotNull('id')->delete();
        $translatables = $request->get('translatable');
        foreach ($translatables as $lang => $translatable) {
            foreach ($translatable['name'] as $block => $name) {
                $footer_main = FooterLinks::create([]);
                FooterLinkTranslation::create(['title' => $name, 'locale' => $lang, 'footer_links_id' => $footer_main->id]);
                foreach ($translatable['link'][$block] as $key => $val) {
                    $footer = FooterLinks::create(['link' => $val, 'parent_id' => $footer_main->id]);
                    FooterLinkTranslation::create(['title' => $translatable['title'][$block][$key], 'locale' => $lang, 'footer_links_id' => $footer->id]);
                }
            }

        }
        return redirect()->back();
    }

    public function getGeoZones()
    {
        return $this->view('store.shipping');
    }

    public function geoZoneForm(Countries $countries, Settings $settings, $id = null)
    {
        $activePayments = $settings->where('section', 'active_payments_gateways')->where('val', 1)->pluck('key', 'section');
        $tax_rates = TaxRates::where('is_active', 1)->get()->pluck('name', 'id')->toArray();
        $active_couriers = Settings::LeftJoin('couriers', 'bty_settings.key', '=', 'couriers.id')
            ->where('bty_settings.section', 'active_couriers')
            ->where('bty_settings.val', '1')
            ->select('couriers.*')
            ->LeftJoin('courier_translations', 'couriers.id', '=', 'courier_translations.couriers_id')
            ->where('courier_translations.locale', app()->getLocale())
            ->select('couriers.*', 'courier_translations.name')
            ->pluck('name', 'id');
        $geo_zone = GeoZones::find($id);
        $delivery_types = DeliveryCostsTypes::all()->pluck('title', 'id');
        $countries = [null => 'Select Country'] + $countries->all()->pluck('name.common', 'name.common')->toArray();

        return $this->view('store.general.new_shipping_zone', compact(
            'countries',
            'geo_zone',
            'activePayments',
            'active_couriers', 'delivery_types', 'tax_rates'));
    }


    public function saveGeoZone(GeoZonesRequest $request)
    {

        $data = $request->except('_token', 'delivery_cost', 'delivery_cost_types_id');
        $delivery_costs = $request->get('delivery_cost');
        $geo_zone = GeoZones::updateOrCreate(['id' => $request->id], $data);
        $countries = $request->get('country');
        $regions = $request->get('region');
        $geo_zone->countries()->whereNotIn('name', $countries)->delete();
        foreach ($countries as $key => $country) {
            $zone_country = $geo_zone->countries()->where('name', $country)->first();
            if (!$zone_country) {
                $zone_country = $geo_zone->countries()->create(['name' => $country, 'all' => 0]);
            }
            $zone_country->regions()->whereNotIn('name', $regions[$key])->delete();
            if ($zone_country) {
                foreach ($regions[$key] as $region) {
                    $zone_country->regions()->create(['name' => $region]);
                }
            }
        }

        foreach ($delivery_costs as $key => $delivery_cost) {
            $options = $delivery_cost['options'];
            $delivery_cost['delivery_cost_types_id'] = $request->get('delivery_cost_types_id');
            unset($delivery_cost['options']);
            if (!$request->id) $key = null;
            $delivery = $geo_zone->deliveries()->updateOrCreate(['id' => $key], $delivery_cost);
            foreach ($options as $key => $value) {
                $options[$key]['delivery_cost_id'] = $delivery->id;
                if ($request->id) {
                    $delivery->options()->updateOrCreate(['id' => $key], $value);
                }
            }
            if (!$request->id) {
                \DB::table('delivery_cost_options')->insert($options);
            }
        }

        return ['error' => false, 'url' => route('admin_settings_shipping')];
    }

    public function findRegion(Request $request)
    {
        $countries = new Countries();
        $regions = $countries->whereNameCommon($request->get('country'))->first()->hydrateStates()->states->pluck('name', 'name')->toArray();
        $id = uniqid();
        $html = \Form::select('region[' . $request->get('count') . '][]', $regions, null, ['class' => 'form-control region select-' . $id . '', 'multiple' => 'multiple'])->toHtml();
        $html .= ' <input type="checkbox" class="select-all" data-select="select-' . $id . '">Select All';
        return ['error' => false, 'html' => $html];
    }

    public function getStore(Currencies $currencies, SiteCurrencies $siteCurrencies, Settings $settings, Request $request)
    {
        $model = $settings->getEditableData('store_out_of_stock');
        $siteCurrencies = $siteCurrencies->get();
        $currencies = $currencies->all()->pluck('name', 'currency');

        return $this->view('store.general', compact('currencies', 'siteCurrencies', 'model'));
    }

    public function currencyGetLive(Request $request, \App\Models\GetForexData $forexData)
    {
        $rates = $forexData->latest($request->code);
        if (isset($rates['rates'][$request->code])) {
            $rate = $rates['rates'][$request->code];
            return \Response::json(['error' => false, 'rate' => $rate]);
        }

        return \Response::json(['error' => true]);
    }

    public function currencyData(Request $request, Currencies $currencies)
    {
        $model = $currencies->where('currency', $request->code)->first();
        if ($model) {
            return \Response::json(['error' => false, 'data' => $model]);
        }

        return \Response::json(['error' => true]);
    }

    public function postStore(Request $request, SiteCurrencies $siteCurrencies, Settings $settings)
    {
        $settings->updateOrCreateSettings('store_out_of_stock', ['out_of_stock_status' => $request->get('out_of_stock_status')]);

        $data = $request->get('currencies');
        $notDeletable = [];
        if (count($data)) {
            foreach ($data as $key => $currency) {

                if ($currency['code'] == $request->is_default) {
                    $currency['is_default'] = true;
                } else {
                    $currency['is_default'] = false;
                }

                $v = $siteCurrencies->where('code', $currency['code'])->first();

                if ($v) {
                    $v->update($currency);
                } else {
                    $v = $siteCurrencies->create($currency);
                }

                $notDeletable[] = $v->id;
            }
        }

        $siteCurrencies->whereNotIn('id', $notDeletable)->delete();

        return redirect()->back();
    }


    public function getStorePaymentsGateways(Settings $settings)
    {
        $model = $settings->getEditableData('active_payments_gateways');
        return $this->view('store.payments_gateways', compact('model'));
    }


    public function getStorePaymentsGatewaysSettings(Settings $settings)
    {
        $model = $settings->getEditableData('payments_gateways');
        return $this->view('store.payments_gateways.settings', compact('model'));
    }

    public function postStorePaymentsGatewaysSettings(Request $request, Settings $settings)
    {
        $settings->updateOrCreateSettings('payments_gateways', $request->except('_token'));
        return redirect()->back();
    }

    public function getStorePaymentsGatewaysCash(Settings $settings)
    {
        $model = $settings->getEditableData('payments_gateways_cash');
        return $this->view('store.payments_gateways.cash', compact('model'));
    }

    public function postStorePaymentsGatewaysCash(Request $request, Settings $settings)
    {
        $settings->updateOrCreateSettings('payments_gateways_cash', $request->except('_token'));
        return redirect()->back();
    }

    public function getStorePrinting(Settings $settings)
    {
        $model = $settings->getEditableData('printing');
        $printers = collect([]);

        if($model && $model->printers){
            $printers = collect(json_decode($model->printers,true));
        }
        return $this->view('store.print', compact('model','printers'));
    }

    public function postStorePrinting(Request $request, Settings $settings)
    {
        $settings->updateOrCreateSettings('printing', $request->except('_token'));
        return redirect()->back();
    }

    public function postStorePaymentsGatewaysEnable(Request $request, Settings $settings)
    {
        $data[$request->get('key')] = ($request->get('onOff') == 'true') ? 1 : 0;
        $settings->updateOrCreateSettings('active_payments_gateways', $data);
        return 1;
    }

    public function postCouriersEnable(Request $request, Settings $settings)
    {
        $data[$request->get('key')] = ($request->get('onOff') == 'true') ? 1 : 0;
        $settings->updateOrCreateSettings('active_couriers', $data);
        return 1;
    }

    public function getCouriers(Settings $settings)
    {
        $model = $settings->getEditableData('active_couriers');
        $couriers = Couriers::all();
        return $this->view('store.couriers', compact('model', 'couriers'));
    }

    public function getCouriersEdit($id)
    {
        $model = Couriers::find($id);
        return $this->view('store.couriers.edit', compact('model'));
    }
    public function getCreateCouriers()
    {
        $model = null;
        return $this->view('store.couriers.edit', compact('model'));
    }

    public function getCouriersSave(Request $request)
    {
        Couriers::updateOrCreate($request->id, $request->except('_token'));
        return redirect()->route('admin_settings_couriers');
    }

    public function getDeliveryCost(Settings $settings)
    {
        $model = $settings->getEditableData('deliverycost');
        return $this->view('store.delivery_cost', compact('model'));
    }

    public function getTaxRates(Settings $settings)
    {
        $tax_rates = TaxRates::all();
        return $this->view('store.tax_rates', compact('tax_rates'));
    }

    public function getCreateRate($id = null)
    {
        $model = TaxRates::find($id);
        return $this->view('store.tax_rates.create', compact('model'));
    }

    public function postCreateOrUpdateTaxRate(Request $request)
    {
        TaxRates::updateOrCreate($request->id, $request->except('_token', 'translatable'));
        return redirect()->route('admin_settings_tax_rates');
    }

    public function postTaxRatesEnable(Request $request)
    {

        $tax = TaxRates::find($request->get('key'));
        $tax->is_active = ($request->get('onOff') == 'true') ? 1 : 0;
        $tax->save();
        return 1;
    }

    public function searchPaymentOptions(Request $request, Settings $settings)
    {
        return $settings->where('section', 'active_payments_gateways')->get();


    }

    public function getGifts()
    {
        return $this->view('store.gifts');
    }


    public function getGiftsManage($id = null)
    {
        $products = Products::where('status', 'published')->get()->pluck('name', 'id');
        $productsTableColumns = collect(\DB::select('show columns from products'))->pluck('Field', 'Field');
        return $this->view('store.gifts.manage', compact('products', 'productsTableColumns'));
    }

    public function postGiftsManage(Request $request)
    {
        $gifts = $request->except('_token');
//        dd($request->all());
    }

    public function getTC()
    {
        $model = Common::where('type', 'tc')->first();

        return $this->view('tc', compact(['model']));
    }

    public function postTC(Request $request)
    {
        $data = $request->except('_token', 'translatable');
        Common::updateOrCreate($request->id, $data, $request->get('translatable'));

        return redirect()->back();
    }

    public function getAboutUs()
    {
        $model = Common::where('type', 'about_us')->first();

        return $this->view('about_us', compact(['model']));
    }

    public function postAboutUs(Request $request)
    {
        $data = $request->except('_token', 'translatable');
        Common::updateOrCreate($request->id, $data, $request->get('translatable'));

        return redirect()->back();
    }

    public function getConnections(Settings $settings)
    {
        $manage_api_settings = $settings->getEditableData('manage_api_settings');
        return $this->view('connections', compact('manage_api_settings'));
    }

    public function postConnections(Request $request, Settings $settings)
    {
        try {
            $data = $request->only(['MAIL_DRIVER', 'MAIL_PORT', 'MAIL_HOST', 'MAIL_USERNAME', 'MAIL_PASSWORD', 'MAIL_ENCRYPTION']);
            $path = base_path('.env');
            if (file_exists($path)) {
                file_put_contents($path, str_replace(
                    'MAIL_DRIVER=' . env('MAIL_DRIVER'), 'MAIL_DRIVER=' . $data['MAIL_DRIVER'], file_get_contents($path)
                ));
                file_put_contents($path, str_replace(
                    'MAIL_HOST=' . env('MAIL_HOST'), 'MAIL_HOST=' . $data['MAIL_HOST'], file_get_contents($path)
                ));
                file_put_contents($path, str_replace(
                    'MAIL_PORT=' . env('MAIL_PORT'), 'MAIL_PORT=' . $data['MAIL_PORT'], file_get_contents($path)
                ));
                file_put_contents($path, str_replace(
                    'MAIL_USERNAME=' . env('MAIL_USERNAME'), 'MAIL_USERNAME=' . $data['MAIL_USERNAME'], file_get_contents($path)
                ));
                file_put_contents($path, str_replace(
                    'MAIL_PASSWORD=' . env('MAIL_PASSWORD'), 'MAIL_PASSWORD=' . $data['MAIL_PASSWORD'], file_get_contents($path)
                ));
                file_put_contents($path, str_replace(
                    'MAIL_ENCRYPTION=' . env('MAIL_ENCRYPTION'), 'MAIL_ENCRYPTION=' . $data['MAIL_ENCRYPTION'], file_get_contents($path)
                ));
            }
        } catch (\Exception $exception) {
            return redirect()->back()->with(['alert' => ['message' => $exception->getMessage(), 'class' => 'danger']]);
        }

        return redirect()
            ->back()
            ->with(['alert' => ['message' => 'New SMTP service connection made successfully!!!', 'class' => 'success']]);
    }

    public function getHomePage(Settings $settings)
    {
        $model = $settings->getEditableData('banners');
        return $this->view('home_page', compact(['model']));
    }

    public function getMainPages(Settings $settings, Request $request)
    {
        $p = $request->get('p', 'banners');
        $top=null;
        $bottom=null;
        $model=null;
        $models = [];
        if($p == 'ads'){
            $models = [];
            $models['single_product'] = $settings->getEditableData('single_product');
            $models['single_post'] = $settings->getEditableData('single_post');
            $models['my_account'] = $settings->getEditableData('my_account');
            $models['confirmation_page'] = $settings->getEditableData('confirmation_page');
            $models['lef_faq_ads'] = $settings->getEditableData('lef_faq_ads');
            $models['right_faq_ads'] = $settings->getEditableData('right_faq_ads');

        } else if ($p == 'banners' || $p == "single_product" || $p == "single_post" || $p == "my_account"||$p == "stickers" || $p == "brands") {
            $model = $settings->getEditableData($p);
            $top = $settings->getEditableData('top');
            $bottom = $settings->getEditableData('bottom_banner');

        } else {
            $model = Common::where('type', $p)->first();
        }
        $items=[];
        if ($p == 'banners'){
            $items=Stock::all()->pluck('name','id');
        }

        return $this->view('main_pages', compact(['model', 'p','items','top','models','bottom']));
    }



    public function postHomePage(Request $request, Settings $settings)
    {
        $banners = array_filter($request->get('banners', []));
        $settings->updateOrCreateSettings('banners', ['data' => $banners]);

        return redirect()->back();
    }

    public function postMainPages(Request $request, Settings $settings)
    {
        $p = $request->get('p', 'banners');

        if ($p == "banners" || $p == "single_product" || $p == "single_post"
            || $p == "my_account"|| $p == "stickers" || $p == 'confirmation_page'  || $p == "brands"|| $p == "lef_faq_ads"|| $p == "right_faq_ads") {
            $banners = array_filter($request->get($p, []));
            $settings->updateOrCreateSettings($p, ['data' => $banners]);
        } else {

            $data = $request->except('_token', 'translatable','p');
            Common::updateOrCreate($request->id, $data,$request->get('translatable'));
        }
        if ($request->exists('top')){
            $settings->updateOrCreateSettings('top', ['data'=>$request->get('top')]);
        }
        if ($request->exists('bottom_banner')){
            $settings->updateOrCreateSettings('bottom_banner', ['data'=>$request->get('bottom_banner')]);
        }
        return redirect()->back();
    }

}
