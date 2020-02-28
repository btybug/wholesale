<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 10/10/2018
 * Time: 4:24 PM
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Filters;
use App\Models\Items;
use App\Models\StockVariation;
use Illuminate\Http\Request;

class FiltersController extends Controller
{
    protected $view = 'admin.tools.filters';

    public function index()
    {
        return $this->view('index');
    }

    public function getCreateOrEdit($id = null)
    {
        $category = Category::findOrFail($id);
        enableMedia();
        return $this->view('edit_or_create', compact('category'));
    }

    public function getItems(Request $request)
    {
        $filter = Filters::find($request->get('id'));
        $attr = Items::whereNotIn('id', $filter->items->pluck('id')->toArray())->get();
        return \Response::json(['error' => false, 'data' => $attr]);
    }

    public function postDelete(Request $request)
    {
        $model = Filters::findOrFail($request->get('slug'));
        $model->delete();
        return response()->json(['error' => false]);
    }

    public function postDetachItem(Request $request, $id)
    {
        $model = Filters::findOrFail($id);
        return response()->json(['error' => !$model->items()->detach($request->get('slug'))]);
    }

    public function postEditCategory(Request $request, $id)
    {
        Category::updateOrCreate($id, []);
        return redirect()->back();
    }

    public function postFilterForm(Request $request)
    {
        $id = $request->get('id', 0);
        $category_id = $request->get('category_id');
        $child_id = $request->get('child_id');
        $category = Category::find($category_id);
        $parent = Filters::find($id);
        $child = (!$category) ? $parent->children()->find($child_id) : $category->filters()->find($child_id);
        $html = $this->view("create_or_update", compact(['parent', 'child', 'child_id', 'category']))->render();
        return \Response::json(['error' => false, 'html' => $html]);
    }

    public function postGetNext(Request $request)
    {
        $children = $request->get('filters', []);
        $filters = collect([]);
        foreach ($children as $key => $id) {
            if ($id) {
                if ($key > 0) {
                    $f = (isset($filters[$key - 1])) ? $filters[$key - 1]->children()->find($id) : null;
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
        $type = 'filter';
        $items_html = '';
        if (!$filters->last()->children()->exists()) {
            $items = $filters->last()->items()->skip(0)->take(10)->get();
            $type = 'items';
            $items_html = $this->view("items", compact(['items']))->render();
            if (isset($filters[$key])) unset($filters[$key]);
        };

        $html = $this->view("filters", compact(['children', 'filters']))->render();
        return \Response::json(['error' => false, 'html' => $html, 'items_html' => $items_html, 'type' => $type]);
    }


    public function postCreateOrUpdateCategory(Request $request)
    {
        $data = $request->except('_token', 'translatable');

        $filter = Filters::updateOrCreate($request->id, $data);
        return redirect()->back();
    }

    public function postCreateParentCategory(Request $request)
    {
        $data = $request->except('_token', 'translatable');
        $data['user_id'] = \Auth::id();
        $data['type'] = 'filter';
        if (!$request->id) {
            $data['slug'] = $this->slugify($request->get('translatable')['gb']['name']);
        }
        Category::updateOrCreate($request->id, $data);
        return redirect()->back();
    }

    protected function slugify($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }

    public function postCategoryUpdateChild(Request $request, $id)
    {
        $data = $request->except('_token', 'translatable', 'child_id', 'id', 'items');
        $data['category_id'] = (!$data['parent_id']) ? $data['category_id'] : null;
        $filter = Filters::updateOrCreate($request->child_id, $data);
        if (!$filter->children()->exists()) {
            $items = array_merge($filter->getParentItems()->toArray(), $request->get('items', []));
            $filter->items()->sync($items);
            $filter->syncChild();


            $filters = Filters::where('category_id',$filter->category_id)->get();
            $syncItems = [];
            foreach ($filters as $filter){

                if($filter->items && count($filter->items)){
                    foreach ($filter->items as $item){
                        $syncItems[$item->id] = $item;
                    }
                }
            }

            $sections = StockVariation::where('type','filter')->where('filter_category_id',$filter->category_id)->groupBy('variation_id')->get();
            if(count($sections)){
                foreach ($sections as $section){
                    $variations = StockVariation::where('type','filter')
                        ->where('filter_category_id',$filter->category_id)->where('variation_id',$section->variation_id)->pluck('item_id','item_id')->all();

                    if(count($variations)){
                        $newData = array_diff_key($syncItems,$variations);
                        $deletableVariations = array_diff_key($variations,$syncItems);

                        foreach ($newData as $newDatum){

                            StockVariation::create([
                                'stock_id' => $section->stock_id,
                                'item_id' => $newDatum->id,
                                'variation_id' => $section->variation_id,
                                'type' => $section->type,
                                'title' => $section->title,
                                'is_required' => $section->is_required,
                                'name' => $newDatum->name,
                                'description' => $section->description,
                                'image' => $newDatum->image,
                                'qty' => $section->qty,
                                'price' => $newDatum->default_price,
                                'count_limit' => $section->count_limit,
                                'min_count_limit' => $section->min_count_limit,
                                'common_price' => $section->common_price,
                                'display_as' => $section->display_as,
                                'price_per' => $section->price_per,
                                'filter_category_id' => $section->filter_category_id,
                                'price_type' => $section->price_type,
                                'discount_type' => $section->discount_type,
                                'ordering' => $section->ordering,
                            ]);
//                            $section->replicate();
//                            $section->item_id = $newDatum->id;
//                            $section->name = $newDatum->name;
//                            $section->image = $newDatum->image;
//                            $section->price = $newDatum->default_price;
//                            $section->save();
                        }

                        StockVariation::where('type','filter')
                            ->where('filter_category_id',$filter->category_id)->where('variation_id',$section->variation_id)
                            ->whereIn('item_id',$deletableVariations)->delete();
                    }
                }
            }

        }
        return redirect()->back();
    }


}
