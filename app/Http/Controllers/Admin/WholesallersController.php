<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 10/10/2018
 * Time: 4:24 PM
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Exports;
use App\Models\Permissions;
use App\Models\Roles;
use Illuminate\Http\Request;

class WholesallersController extends Controller
{
    protected $view = 'admin.wholesallers';

    public function index()
    {
        $exports=Exports::orderBy('id','ASC')->get();
        return $this->view('index',compact('exports'));
    }

    public function viewItems($id)
    {
        $exports=Exports::find($id);
        $items=$exports->items;

        return $this->view('view',compact('items'));
    }
    public function manage($id)
    {
        $exports=Exports::find($id);
        return $this->view('manage',compact('exports'));
    }
}
