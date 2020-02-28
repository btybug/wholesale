<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 3/27/2019
 * Time: 3:35 PM
 */

namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Filters;
use App\Models\Items;
use App\Models\StockVariation;
use Illuminate\Http\Request;

class FilterApiControll extends Controller
{
    protected $view='filters';
    public function postGetNext(Request $request)
    {
        $children = $request->get('filters', []);
        $category_id = $request->get('category_id');
        $category=Category::findOrFail($category_id);
        $filters = collect([]);

        foreach ($children as $key => $id) {
            if ($id) {
                if ($key > 0) {
                    $f = (isset($filters[$key - 1]))?$filters[$key - 1]->children()->find($id):null;
                } else {
                    $f = Filters::find($id);
                }
                if ($f) {
                    $filters->push($f);

                } else {
                    break;
                };
            }
        }
        switch ($request->get('type')){
            case'popup':$view='button_types';break;
            case'select_filter':$view='select_types';break;
        }
        $type = 'filter';
        $items_html = '';
        if ($filters->count() && !$filters->last()->children()->exists()) {

            $items = getItemStockVariations($request->get('group'),$filters->last()->items->pluck('id')->toArray());
            $type = 'items';
            $items_html = $this->view($view.".items", compact(['items']))->render();
            isset($filters[$key]);
            unset($filters[$key]);
        };

        $html = $this->view($view.".filters", compact([ 'filters','category','children']))->render();
        $wizard = $this->view($view.".wizard", compact(['filters','category']))->render();
        return \Response::json(['error' => false, 'filters' => $html, 'wizard'=>$wizard,'items_html' => $items_html, 'type' => $type]);
    }

    public function postRenderTabs(Request $request)
    {
        $variations = StockVariation::where('variation_id',$request->group)->get();
        $filters = ($variations && $variations->first()->filter) ? $variations->first()->filter->filters : collect([]);

//        $all = Items::leftJoin("filter_items",'items.id',"filter_items.item_id")
//            ->leftJoin('filters','filter_items.filter_id','filters.id')
//            ->leftJoin('filters','filter_items.filter_id','filters.id')
//            ->select('items.*')
//            ->whereIn('filters.id',$filters->pluck('id','id')->all())
//            ->groupBy('items.id')
//            ->get();


        $html = view("filters.filter_modal_body",compact(['filters','variations']))->with('group',$request->group)->render();

        return response()->json(['error' => false,'html'=> $html]);
    }
}
