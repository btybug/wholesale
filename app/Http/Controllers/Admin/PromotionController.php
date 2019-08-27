<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 2/18/2019
 * Time: 2:42 PM
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\ProductsRequest;
use App\Models\Attributes;
use App\Models\Category;
use App\Models\Filters;
use App\Models\Items;
use App\Models\Settings;
use App\Models\Stickers;
use App\Models\Stock;
use App\Models\StockSales;
use App\Models\StockSeo;
use App\Services\StockService;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    protected $view = 'admin.store.promotion';

    private $settings;

    public function __construct(Settings $settings)
    {
        $this->settings = $settings;
    }

    public function getIndex()
    {
        return $this->view('index', compact([]));
    }

    public function getNew()
    {
        $model = null;
        return $this->view('new', compact(['model']));
    }

    public function getPromotionEdit($id, Request $request)
    {
        $model = Stock::findOrFail($id);
        $type = $request->get('type', 'all');
        $now = strtotime(today()->toDateString());

        if ($type == 'all') {
            $sales = $model->sales()->groupBy('slug')->get();
        } else if ($type == 'archived') {
            $sales = $model->sales()->where('canceled', true)->groupBy('slug')->get();
        } else if ($type == 'coming') {
            $sales = $model->sales()->where('canceled', false)->where('start_date', '>', $now)->groupBy('slug')->get();
        } else if ($type == 'current') {
            $sales = $model->sales()->where('canceled', false)->where('start_date', '<=', $now)->where('end_date', '>=', $now)->groupBy('slug')->get();
        }

        return $this->view('stock_promotions', compact(['model', 'sales', 'type']));

    }

    public function getPromotionVariations(Request $request)
    {
        $stock = Stock::find($request->stock_id);
        $model = Stock::findOrFail($request->id);
        $type = $request->type;
        $price = json_decode($request->price, true);
//        dd($price);

        $html = \View("admin.inventory._partials.extra_item", compact(['model', 'type', 'price', 'stock']))->render();
//        dd($html);
//        dd(\Response::json(['error' => false, 'html' => $html]));
        return \Response::json(['error' => false, 'html' => $html]);
    }

    public function getPromotion(Request $request)
    {
        $model = Stock::findOrFail($request->stock_id);
        $promotion = ($request->get('slug')) ? StockSales::where('slug', $request->get('slug'))->first() : null;
        $variations = collect($model->variations()->where('is_required', true)->get())->groupBy('variation_id');
        $stockItems = Items::active()->get()->pluck('name', 'id')->all();

        $html = \View("admin.inventory._partials.promotion_item", compact(['model', 'promotion','variations','stockItems']))->render();
        return \Response::json(['error' => false, 'html' => $html]);
    }

    public function savePromotion(Request $request)
    {
        $data = $request->except('extra_product', 'stock_id');
        $stock = Stock::findOrFail($request->stock_id);

        $sale = $stock->sales()->where('canceled', false)->where('start_date', '<=', strtotime($data['start_date']))->where('end_date', '>=', strtotime($data['start_date']))
            ->orWhere(function ($query) use ($data) {
                $query->where('canceled', false)->where('start_date', '<=', strtotime($data['end_date']))->where('end_date', '>=', strtotime($data['end_date']));
            })
            ->first();

        if ($sale) return \Response::json(['error' => true, 'message' => 'Please select another dates for promotion, we have active promotion with these dates...']);

        if ($request->get('extra_product') && count($request->get('extra_product'))) {
            foreach ($request->get('extra_product') as $key => $item) {
                $sale = $stock->sales()->where('variation_id', $key)->where('slug', $data['slug'])->first();
                $data['variation_id'] = $key;
                $data['price'] = $item['price'];
                if ($sale) {
                    $sale->update($data);
                } else {
                    $stock->sales()->create($data);
                }
            }
        }

        return \Response::json(['error' => false]);
    }
}
