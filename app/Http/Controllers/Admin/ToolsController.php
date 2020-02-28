<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 10/10/2018
 * Time: 4:24 PM
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Attributes;
use App\Models\Stickers;
use Illuminate\Http\Request;

class ToolsController extends Controller
{
    protected $view = 'admin.tools';

    public function index()
    {
        return $this->view('index');
    }

    public function stickers()
    {
        $stickers = Stickers::all();
        $attributes = Attributes::get()->pluck('name','id')->all();
        return $this->view('stickers',compact(['stickers','attributes']));
    }

    public function postStickersManage(Request $request)
    {
        $data=$request->except(['_token','translatable','attributes'],[]);
        $sticker = Stickers::updateOrCreate($request->id,$data);
        $attributes = $request->get('attributes',[]);

        if(count($attributes)){
            foreach ($attributes as $attribute){
                $attr = Attributes::find($attribute);
                if($attr && ! $attr->stickers->contains($sticker->id)){
                    $attr->stickers()->attach($sticker->id);
                }
            }
        }

        return redirect()->back();
    }

    public function postStickersManageForm(Request $request)
    {
        $model=Stickers::findOrFail($request->get('id'));
        $path=$this->view.'.stickers_form';
        $attributes = Attributes::get()->pluck('name','id')->all();

        $html=\View::make($path)->with(['model'=>$model,'attributes' => $attributes])->render();
        return \Response::json(['error'=>false,'html'=>$html]);
    }

    public function postStickersNewForm(Request $request)
    {
        $path=$this->view.'.stickers_form';
        $attributes = Attributes::get()->pluck('name','id')->all();

        $html=\View::make($path)->with(['model'=>null,'attributes' => $attributes])->render();
        return \Response::json(['error'=>false,'html'=>$html]);
    }

    public function postAll (Request $request)
    {
        $attr = Stickers::whereNotIn('id', $request->get('arr',[]))->get();
        return \Response::json(['error' => false,'data' => $attr]);
    }

    public function postDelete(Request $request)
    {
        $model=Stickers::findOrFail($request->get('slug'));

        $model->delete();

        return \Response::json(['error'=> false,'url' => route('admin_tools_stickers')]);
    }

    public function getFilters()
    {
        return $this->view('filters.index',compact());
    }
}
