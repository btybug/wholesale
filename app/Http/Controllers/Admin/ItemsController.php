<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 11/26/2018
 * Time: 10:34 AM
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Admin\Requests\SupplierRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\Requests\ItemsRequest;
use App\Models\Attributes;
use App\Models\Items;
use App\Models\Suppliers;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    protected $view = 'admin.items';

    public function index()
    {
        return $this->view('index');
    }

    public function getNew()
    {
        $model = null;
        $allAttrs = Attributes::with('children')->whereNull('parent_id')->get();
        return $this->view('new', compact('model', 'allAttrs'));
    }

    public function postNew(ItemsRequest $request)
    {
        $data = $request->only('sku', 'image');

        $item = Items::updateOrCreate($request->id, $data);
        $this->saveImages($request, $item);
        $this->saveVideos($request, $item);
        $this->saveDownloads($request, $item);

        $item->suppliers()->sync($request->get('suppliers'));

        return redirect()->route('admin_items');
    }

    public function getEdit($id)
    {
        $model = Items::findOrFail($id);
        $allAttrs = Attributes::with('children')->whereNull('parent_id')->get();
        return $this->view('new', compact('model', 'allAttrs'));
    }

    private function saveImages(Request $request, $item)
    {
        $images = $request->get('other_images');
        if ($images) {
            $data = [];
            foreach ($images as $image) {
                $data[] = ['url' => $image, 'type' => 'image', 'item_id' => $item->id, 'created_at' => date('Y-m-d h:i:s')];
            }
            return \DB::table('items_media')->insert($data);
        }
        return null;
    }

    private function saveVideos(Request $request, $item)
    {
        $videos = $request->get('videos');
        if ($videos) {
            $data = [];
            foreach ($videos as $video) {
                $data[] = ['url' => $video, 'type' => 'video', 'item_id' => $item->id, 'created_at' => date('Y-m-d h:i:s')];
            }
            return \DB::table('items_media')->insert($data);
        }
        return null;
    }

    private function saveDownloads(Request $request, $item)
    {
        $downloads = $request->get('downloads');
        if ($downloads) {
            $data = [];
            foreach ($downloads as $download) {
                $data[] = ['url' => $download, 'type' => 'download', 'item_id' => $item->id, 'created_at' => date('Y-m-d h:i:s')];
            }
            return \DB::table('items_media')->insert($data);
        }
        return null;
    }

    public function getPurchase($id)
    {
        $item = Items::FindOrFail($id);
        return $this->view('purchase', compact('item'));
    }

    public function getSuppliers()
    {
        return $this->view('suppliers.index');
    }

    public function getSuppliersNew()
    {
        $model = null;
        return $this->view('suppliers.new', compact('model'));
    }

    public function getSuppliersEdit($id)
    {
        $model = Suppliers::findOrFail($id);
        return $this->view('suppliers.new', compact('model'));
    }

    public function postSuppliers(SupplierRequest $request)
    {
        $data = $request->except('_token');
        Suppliers::updateOrCreate(['id' => $request->get('id')], $data);
        return redirect()->route('admin_suppliers');
    }

    public function getList(Request $request)
    {
        $attr = Suppliers::whereNotIn('id', $request->get('arr', []))->get();

        return \Response::json(['error' => false, 'data' => $attr]);
    }

    public function syncSupplier(Request $request)
    {
        $item = Items::find($request->get('item_id'));
        if ($item) {
            $item->suppliers()->attach($request->id);

            return \Response::json(['error' => false]);
        }

        return \Response::json(['error' => true, 'message' => 'message']);
    }

    public function deleteSupplier(Request $request)
    {
        $item = Items::find($request->get('item_id'));
        if ($item) {
            $item->suppliers()->detach($request->id);

            return \Response::json(['error' => false]);
        }

        return \Response::json(['error' => true, 'message' => 'message']);
    }

    public function postSuppliersList(Request $request)
    {
        $attr = Suppliers::whereNotIn('id', $request->get('arr', []))->get();

        return \Response::json(['error' => false, 'data' => $attr]);
    }
}