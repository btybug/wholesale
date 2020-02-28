<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 10/10/2018
 * Time: 4:24 PM
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryPost;
use App\Models\Category;
use App\Models\CategoryPost;
use App\Models\Products;
use App\Models\ShippingZones;
use App\Models\Stickers;
use Illuminate\Http\Request;
use Lang;

class CategoriesController extends Controller
{
    protected $view = 'admin.tools.categories';

    public function list()
    {
        $categories=Category::groupBy('type')->get();
        return $this->view('list',compact('categories'));
    }

    public function getCategories($type)
    {
        $categories = Category::whereNull('parent_id')->where('type', $type)->get();
        $allCategories = Category::where('type', $type)->get();
        enableMedia('drive');
        return $this->view('index', compact('categories','allCategories', 'type'));
    }

    public function postCategoryForm(Request $request, $type)
    {
        $id = $request->get('id', 0);
        $model = Category::where('id', $id)->where('type', $type)->first();

        $allCategories = Category::where('id', '!=', $id)->where('type', $type)->get();
        $stickers = Stickers::all()->pluck('name', 'id');
        $html = $this->view("create_or_update", compact(['allCategories', 'model', 'type', 'stickers']))->render();

        return \Response::json(['error' => false, 'html' => $html]);
    }

    public function postCategoryUpdateParent(Request $request, $type)
    {
        $model = Category::where('id', $request->get('id'))->where('type', $type)->first();
        if ($model) {
            $model->parent_id = $request->get('parentId');
            $model->save();
        }

        return \Response::json(['error' => false]);
    }

    public function postCreateOrUpdateCategory(StoreCategoryPost $request, $type)
    {
        $data = $request->except('_token', 'translatable', 'stickers');
        $data['user_id'] = \Auth::id();
        $category = Category::updateOrCreate($request->id, $data);
        $category->stickers()->sync($request->get('stickers'));
        return redirect()->back();
    }

    public function postDeleteCategory(Request $request, $type)
    {
        $model = Category::findOrFail($request->get('slug'));
        $model->delete();

        return response()->json(['error' => false]);
    }

    public function getCategory(Request $request)
    {
        $lang = Lang::getLocale();
        return Category::LeftJoin('categories_translations', 'categories.id', '=', 'categories_translations.category_id')
            ->select('categories.*', 'categories_translations.name')
            ->where('categories_translations.name', 'like', '%' . $request->get('q') . '%')
            ->where('categories_translations.locale', $lang)
            ->get();
    }


}
