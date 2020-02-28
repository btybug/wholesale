<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 10/10/2018
 * Time: 4:24 PM
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\AttributesPost;
use App\Models\Attributes;
use App\Models\Category;
use App\Models\Items;
use App\Services\ItemService;
use Illuminate\Http\Request;

class AttributesController extends Controller
{

    protected $view = 'admin.tools.attributes';

    private $itemService;

    public function __construct(
        ItemService $itemService
    )
    {
        $this->itemService = $itemService;
    }

    public function getAttributes()
    {

        return $this->view('index');
    }

    public function getAttributesCreate()
    {
        $model = null;
        $categories = Category::with('children')->where('type', 'stocks')->whereNull('parent_id')->get();
        $data = Category::recursiveItems($categories, 0, [], []);

        return $this->view('create_edit_form', compact(['model','categories','data']));
    }

    public function postAttributesCreate(Request $request)
    {
        $data = $request->except('_token', 'translatable', 'stickers','categories');
        $data['user_id'] = \Auth::id();
        $attr = Attributes::updateOrCreate($request->id, $data);
        $attr->stickers()->sync($request->get('stickers',[]));
        $attr->categories()->sync(json_decode($request->get('categories', [])));

        return redirect()->route('admin_store_attributes');
    }

    public function getAttributesEdit($id)
    {
        $model = Attributes::findOrFail($id);
        $optionModel = null;
        $categories = Category::with('children')->where('type', 'stocks')->whereNull('parent_id')->get();
        $checkedCategories = $model->categories()->pluck('id')->all();
        $data = Category::recursiveItems($categories, 0, [], $checkedCategories);

        return $this->view('create_edit_form', compact(['model', 'optionModel','categories','data','checkedCategories']));
    }

    public function postAttributesEdit(Request $request, $id)
    {
        $data = $request->except('_token', 'translatable', 'stickers','categories');
        $data['user_id'] = \Auth::id();
        $attr = Attributes::updateOrCreate($request->id, $data);
        $attr->stickers()->sync($request->get('stickers'));
        $oldCatgories = $attr->categories()->pluck('id','id')->all();
        $attr->categories()->sync(json_decode($request->get('categories', [])));

        $items = Items::leftJoin('item_categories','items.id','item_categories.item_id')
            ->select('items.*')->whereIn('item_categories.categories_id',$attr->categories()->pluck('id','id')->all())->groupBy('items.id')->get();

        $removeFrom = array_diff($oldCatgories,$attr->categories()->pluck('id','id')->all());

        $oldItems = Items::leftJoin('item_categories','items.id','item_categories.item_id')
            ->select('items.*')->whereIn('item_categories.categories_id',$removeFrom)->groupBy('items.id')->get();

        $spec =  [
          "5dcc18860215f"  => [
              "attributes_id" => $attr->id
          ]
        ];

        if(count($items)){
            foreach ($items as $item){
                if(! $item->specifications()->where('attributes_id',$attr->id)->first()){
                    $item->specificationsPivot()->attach($spec);
                }
            }
        }

        if(count($oldItems)){
            foreach ($oldItems as $item){
                if($item->specifications()->where('attributes_id',$attr->id)->first()){
                    $item->specificationsPivot()->detach($spec);
                }
            }
        }

        return redirect()->route('admin_store_attributes');
    }

    public function postAttributesOptions(Request $request, $id)
    {
        $model = Attributes::findOrFail($id);
        $data = $request->except('_token', 'translatable');
        $data['user_id'] = \Auth::id();
        Attributes::updateOrCreate($request->id, $data);
        return redirect()->back();
    }

    public function postAttributesOptionsForm(Request $request)
    {
        $model = Attributes::findOrFail($request->parentId);
        $optionModel = Attributes::find($request->id);

        $html = \View("admin.inventory.attributes.options_form", compact(['optionModel', 'model']))->render();
        return \Response::json(['error' => false, 'html' => $html]);
    }

    public function postAttributesOptionDelete(Request $request)
    {
        $model = Attributes::find($request->id);

        if ($model) {
            $model->delete();
            return \Response::json(['error' => false]);
        }

        return \Response::json(['error' => true]);
    }

    public function getOptions(Request $request)
    {
        $attr = Attributes::find($request->id);
        if ($attr) {
            return \Response::json(['error' => false, 'data' => $attr->children]);
        }

        return \Response::json(['error' => true]);
    }


    public function getOptionsAutocomplate(Request $request, $id)
    {
        $lang = \Lang::getLocale();
        $attr = Attributes::find($id);

        $likes = $attr->children()->LeftJoin('attributes_translations', 'attributes.id', '=', 'attributes_translations.attributes_id')
            ->select('attributes.*', 'attributes_translations.name')
            ->where('attributes_translations.name', 'like', '%' . $request->get('q') . '%')
            ->where('attributes_translations.locale', $lang)
            ->get();
        return ($attr) ? $likes : [];
    }

    public function postAllAttributes(Request $request)
    {
        $attr = Attributes::whereNull('parent_id')->whereNotIn('id', $request->get('arr', []))->get();
        return \Response::json(['error' => false, 'data' => $attr]);
    }

    public function getAttributeByID(Request $request)
    {
        $attr = Attributes::find($request->id);
        if ($attr) {
            return \Response::json(['error' => false, 'data' => $attr]);
        }

        return \Response::json(['error' => true]);
    }

    public function getVariationsTable(Request $request)
    {
        $attr = Attributes::find($request->id);
        if ($attr) {
            $options = $attr->children()->get()->pluck('name', 'id');
            $html = \View('admin.inventory.attributes.variations_table', compact(['options']))->render();
            return \Response::json(['error' => false, 'html' => $html]);
        }

        return \Response::json(['error' => true]);
    }

    public function postAttributesDelete(Request $request)
    {
        $model = Attributes::findOrFail($request->slug);
        $model->delete();

        return response()->json(['error' => false]);
    }
}
