<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 11/26/2018
 * Time: 10:34 AM
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use PragmaRX\Countries\Package\Countries;

use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    protected $view = 'admin.inventory.warehouses';

    private $countries;

    public function __construct(
        Countries $countries
    )
    {
        $this->countries = $countries;
    }
    public function index ()
    {
        return $this->view('index');
    }

    public function getNew ()
    {
        $model = null;
        $countries = $this->countries->all()->pluck('name.common', 'name.common')->toArray();

        return $this->view('new', compact('model', 'countries'));
    }

    public function postNew (Request $request)
    {
        dd($request->all());
    }
}