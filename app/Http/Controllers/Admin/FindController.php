<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 31.12.2017
 * Time: 00:15
 */

namespace App\Http\Controllers\Admin;


use App\DataTables\ItemsDataTable;
use App\Http\Controllers\Admin\Requests\AdminProfileRequest;
use App\Http\Controllers\Controller;
use App\ItemsSearch\ItemsSearch;
use App\Models\Barcodes;
use App\Models\Category;
use App\Models\Couriers;
use App\Models\GeoZones;
use App\Models\Orders;
use App\Models\Settings;
use App\Models\Statuses;
use App\ProductSearch\ProductSearch;
use App\Search\Customer\CustomersSearch;
use App\Search\Orders\OrdersSearch;
use App\Services\FindService;
use Illuminate\Http\Request;

class FindController extends Controller
{
    private $geoZones;
    private $findService;

    public function __construct(
        GeoZones $geoZones,
        FindService $findService
    )
    {
        $this->geoZones = $geoZones;
        $this->findService = $findService;
    }

    public function getIndex(Request $request, ItemsDataTable $dataTable)
    {
        $options = $this->findService->getOptions();
        $data = $request->all();
        return $dataTable->render('admin.find.index', compact(['options','data']));
    }

    public function postCallFind(Request $request, ItemsDataTable $dataTable)
    {
        $key = $request->get('key');
        $fn = 'get' . strtoupper($key) . "Data";
        $data = $this->$fn();

        $form = view("admin.find.$key.form", $data)->render();

        return response()->json(['form' => $form]);
    }

    public function getProductsData()
    {
        $categories = Category::where('type', 'stocks')->whereNull('parent_id')->get()->pluck('name', 'id')->all();
        $brands = Category::where('type', 'brands')->whereNull('parent_id')->get()->pluck('name', 'id')->all();

        return ['categories' => $categories, 'brands' => $brands];
    }

    public function getItemsData()
    {
        $categories = Category::where('type', 'stocks')->whereNull('parent_id')->get()->pluck('name', 'id')->all();
        $brands = Category::where('type', 'brands')->whereNull('parent_id')->get()->pluck('name', 'id')->all();
        $barcodes = Barcodes::all()->pluck('code', 'id');
        return compact('categories', 'brands', 'barcodes');
    }

    public function postProductResults(Request $request)
    {
        $products = ProductSearch::apply($request);
        $html = view("admin.find.products.results", compact(['products']))->render();
        return response()->json(['error' => false, 'html' => $html]);
    }

    public function postItemsResults(Request $request, ItemsDataTable $dataTable)
    {
        $products = ItemsSearch::apply($request);
        $html = $dataTable->render("admin.find.items.results")->render();
        return response()->json(['error' => false, 'html' => $html]);
    }

    public function getCustomersData()
    {
        return [];
    }

    public function postCustomersResults(Request $request)
    {
        $customers = CustomersSearch::apply($request);
        $html = view("admin.find.customers.results", compact(['customers']))->render();
        return response()->json(['error' => false, 'html' => $html]);
    }

    public function getOrdersData()
    {
        $settings= new Settings();
        $model = $settings->where('section','active_couriers')->where('val','1')->get();
        $filtered = $model->pluck('key');
        $couriers = Couriers::whereIn('id',$filtered)->get()->pluck('name','id');
        $payments_gateways = $settings->where('section','active_payments_gateways')->where('val','1')->pluck('key','key');
        $users=Orders::leftJoin('users','orders.user_id','=','users.id')->select('users.name as user_name','users.id as user_id')->pluck('user_name','user_id');
        $statuses=Statuses::where('type','order')->get()->pluck('name','id');
        return compact('couriers','payments_gateways','users','statuses');
    }

    public function postOrdersResults(Request $request)
    {
        $orders = OrdersSearch::apply($request);
        $html = view("admin.find.orders.results", compact(['orders']))->render();
        return response()->json(['error' => false, 'html' => $html]);
    }

    public function printHtmlBarcode(Request $request)
    {
        if(! \File::isDirectory(storage_path("app".DS."printer"))){
            \File::makeDirectory(storage_path("app".DS."printer"));
        }

        if(! \File::isDirectory(storage_path("app".DS."printer".DS."barcodes"))){
            \File::makeDirectory(storage_path("app".DS."printer".DS."barcodes"));
        }

        $html = \File::put(storage_path("app".DS."printer".DS."barcodes".DS."barocodes.html"),$request->get('print'));

        $printerId = 'bc1b47fb-d23d-be25-3cb4-78cfa410fc3b';
        \GoogleCloudPrint::asHtml()
            ->file(storage_path("app".DS."printer".DS."barcodes".DS."barocodes.html"))
            ->printer($printerId)
            ->send();

        return response()->json(['error' => false]);
    }
}
