<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 10/10/2018
 * Time: 4:24 PM
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Settings;
use App\Models\Stock;
use App\Models\StockSales;
use App\Models\StockSeo;
use App\Services\StockService;
use Illuminate\Http\Request;


class InventoryController extends Controller
{
    protected $view = 'admin.inventory';

    private $stockService;
    private $settings;

    public function __construct(StockService $stockService, Settings $settings)
    {
        $this->stockService = $stockService;
        $this->settings = $settings;
    }

    private function createOrUpdateSeo($request, $stock_id)
    {
        $types = $request->only(['fb', 'general', 'twitter', 'robot']);
        foreach ($types as $type => $data) {
            foreach ($data as $name => $value) {
                $seo = StockSeo::firstOrNew(['stock_id' => $stock_id, 'name' => $name, 'type' => $type]);
                if ($value) {
                    $seo->content = $value;
                    $seo->save();
                } else {
                    $seo->delete();
                }
            }
        }
    }

    public function getPromotion(Request $request)
    {
        $model = Stock::findOrFail($request->stock_id);
        $promotion = ($request->get('slug')) ? StockSales::where('slug', $request->get('slug'))->first() : null;
        $html = \View("admin.inventory._partials.promotion_item", compact(['model', 'promotion']))->render();
        return \Response::json(['error' => false, 'html' => $html]);
    }


}
