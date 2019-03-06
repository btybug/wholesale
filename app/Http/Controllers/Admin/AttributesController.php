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
use Illuminate\Http\Request;

class AttributesController extends Controller
{

    protected $view = 'admin.tools.attributes';

    public function getAttributes()
    {

        return $this->view('index');
    }

    public function getAttributesCreate()
    {
        $model = null;
        return $this->view('create_edit_form', compact(['model']));
    }

    public function postAttributesCreate(Request $request)
    {
        $data = $request->except('_token', 'translatable', 'stickers');
        $data['user_id'] = \Auth::id();
        $attr = Attributes::updateOrCreate($request->id, $data);
        $attr->stickers()->sync($request->get('stickers'));
        return redirect()->route('admin_store_attributes');
    }

    public function getAttributesEdit($id)
    {
        $model = Attributes::findOrFail($id);
        $optionModel = null;
        return $this->view('create_edit_form', compact(['model', 'optionModel']));
    }

    public function postAttributesEdit(Request $request, $id)
    {
        $data = $request->except('_token', 'translatable', 'stickers');
        $data['user_id'] = \Auth::id();
        $attr = Attributes::updateOrCreate($request->id, $data);
        $attr->stickers()->sync($request->get('stickers'));
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