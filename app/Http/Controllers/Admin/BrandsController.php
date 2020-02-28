<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Brands;
use App\Models\Category;
use App\Models\Stickers;
use Illuminate\Http\Request;

class BrandsController extends Controller
{
    protected $view = 'admin.blog.brands';

    public function index()
    {
        return $this->view('index');
    }

    public function create()
    {
        $stickers = Stickers::all()->pluck('name', 'id');
        return $this->view('create',compact('stickers'));
    }
    public function edit($id)
    {
        $stickers = Stickers::all()->pluck('name', 'id');
        $model=Brands::findOrFail($id);
        return $this->view('edit',compact('stickers','model'));
    }

    public function postCreateOrUpdateBrand(Request $request)
    {
        $data = $request->except('_token', 'translatable', 'stickers');
        $category = Brands::updateOrCreate($request->id, $data);
        $category->stickers()->sync($request->get('stickers'));
        if($request->get('id')){
            return redirect()->back();
        }
        return redirect()->route('admin_blog_brands');
    }

    public function fixBrands()
    {
        $categories=Category::with('translations')->where('type','brands')->get();
        $attributes=['id','slug','image','icon','classes'];
        $translations=['name','description','locale'];

        foreach ($categories as $key=>$category){
            foreach ($attributes as $attribute){
                $brands[$key][$attribute]=$category[$attribute];
            }
            foreach ($category->translations as $translation){

                $brandTranslations[]=[
                    'locale'=>$translation->locale,
                    'name'=>$translation->name,
                    'description'=>$translation->description,
                    'brands_id'=>$category->id,
                ];

            }
        }
        \DB::table('brands')->insert($brands);
        \DB::table('brands_translations')->insert($brandTranslations);
        dd('done');


    }
}
