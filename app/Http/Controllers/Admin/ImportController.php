<?php
/**
 * Created by PhpStorm.
 * User: hook
 * Date: 1/15/2019
 * Time: 4:00 PM
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Import;
use App\Models\Posts;
use App\Models\Stock;
use Illuminate\Http\Request;
use Auth;

use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use File;
use Storage;
//use Illuminate\Http\File;

class ImportController extends Controller
{
    protected $view = 'admin.import';

    public function export()
    {
        return Excel::download(new UsersExport, 'stock.csv');
    }

    public function index()
    {
        $imports = Import::get();
//        dd($imports);
        return $this->view('index',compact(["imports"]));
    }

    public function import(Request $request)
    {
        $rules = [
//            'exl_file' => 'required|max:10000|mimes:csv',
            'category' => 'required',
        ];

        $this->validate($request,$rules);


        $file = $request->file('exl_file');
        $category = $request->category;

        //Get unique name
        $time = time();
        $file_name = $time . $file->getClientOriginalName();

        //Move Uploaded File
        $destinationPath = 'storage/app/public/excel';
        $file->move($destinationPath,$file_name);

        $import = new Import();
        $import->user_id = Auth::user()->id;
        $import->category = $category;
        $import->path = "public/excel/".$file_name;
        $import->save();
        return redirect()->back();

    }

    public function delete_file(Request $request)
    {
        $id = $request->id;
        $file = Import::find($id);

        Storage::delete($file->path);
        Import::find($id)->delete();

    }

    public function add_file(Request $request)
    {



        $id = $request->id;
        \DB::transaction(function () use($id){
            $file = Import::find($id);


            if(isset($file)){
                $fn = $file->category;
                $this->$fn($file);
                $file->update([
                    "is_imported" => "1"
                ]);
            }

        });


    }

    public function view_file(Request $request)
    {
        $id = ($request->id) ? $request->id : 1;
        $file = Import::find($id);
        $excels = Excel::toArray(new UsersImport, $file->path)[0];
//        $row = array_shift($excels);
//        $data = [];
//        dd($row,$excels);

//        foreach ($row as $i => $item){
//            $data[$item] = $excel[$i];
//        }
        return response()->json($excels);
    }

    public function stock($file){
        $excels = Excel::toArray(new UsersImport, $file->path)[0];
        $row = array_shift($excels);
        $object = new Stock;
        $translatable = $object->translatedAttributes;
        foreach($excels as $excel){
            $data = [];
            $translatableData = [];
            foreach ($row as $i => $item){
                if(in_array($item,$translatable)){
                    $translatableData[app()->getLocale()][$item] = $excel[$i];
                }else{
                    $data[$item] = $excel[$i];
                }
            }
            $data['user_id'] = Auth::id();
            Stock::updateOrCreate(null,array_filter($data),$translatableData);
        }

    }

    public function post($file){
        $excels = Excel::toArray(new UsersImport, $file->path)[0];
        $row = array_shift($excels);
        $object = new Posts();
        $translatable = $object->translatedAttributes;
        foreach($excels as $excel){
            $data = [];
            $translatableData = [];
            foreach ($row as $i => $item){
                if(in_array($item,$translatable)){
                    $translatableData[app()->getLocale()][$item] = $excel[$i];
                }else{
                    $data[$item] = $excel[$i];
                }
            }
            $data['user_id'] = Auth::id();
            Posts::updateOrCreate(null,array_filter($data),$translatableData);
        }

    }

}