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
use App\Models\Category;
use App\Models\Tags;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    protected $view = 'admin.tools.tags';

    public function getIndex()
    {
        return $this->view('index');
    }

    public function tagsSave(Request $request)
    {
        $data = $request->get('tags');
        if ($data) {
            $data = explode(',', $data);
            if (count($data)) {
                foreach ($data as $tag) {
                    Tags::updateOrCreate(['name' => $tag],['name' => $tag]);
                }
            }
        }

        return \Response::json(['error' => false,'data' => Tags::all()]);
    }

    public function postSearch(Request $request)
    {
        return Tags::where('name',"LIKE","%".$request->q."%")->get();
    }

    public function postDelete(Request $request)
    {
        $tag = Tags::findOrFail($request->slug);
        $tag->delete();

        return response()->json(['error' => false,'callback' => true,'data' =>Tags::all() ]);
    }

}