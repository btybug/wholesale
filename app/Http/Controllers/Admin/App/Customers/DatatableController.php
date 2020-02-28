<?php

namespace App\Http\Controllers\Admin\App\Customers;


use App\Http\Controllers\Controller;
use App\Http\Services\WholesaleService;
use App\Models\Orders;
use App\Models\Staff;
use App\Models\StaffRoles;
use App\RemoteModels\Items;
use Yajra\DataTables\Facades\DataTables;


class DatatableController extends Controller
{


    public function getAllItems()
    {
        return Datatables::of(Items::query())
            ->editColumn('name', function ($attr) {
                return $attr->name;
            })->addColumn('select', function ($attr) {
                return '
                <div class="form-check form-check-inline">
                    <label class="form-check-label">
                      <input class="items-checkbox form-check-input" type="checkbox" name="items[]" value="'.$attr->id.'"> &nbsp;
                      <span class="form-check-sign">
                        <span class="check"></span>
                      </span>
                    </label>
                  </div>
                ';
            })->editColumn('short_description', function ($attr) {
                return $attr->short_description;
            })->editColumn('barcode_id', function ($attr) {
                return ($attr->barcode)?$attr->barcode->code:'no barcode';
            })->editColumn('long_description', function ($attr) {
                return $attr->long_description;
            })
            ->addColumn('actions', function ($attr) {
                return '';
//                    '<a rel="tooltip" class="btn btn-success btn-link" href="#" data-original-title="" title="">
//                                <i class="material-icons">import_export</i></a>';
            })
            ->rawColumns(['select'])->make(true);
    }

    public function getAllPurchase(WholesaleService $wholesaleService)
    {
        $response = $wholesaleService->getOrdersAndItems();
        $items= $response['items'];
        return Datatables::of($items) ->addColumn('actions', function ($attr) {
            return (!$attr['is_exported'])?
                    '<a rel="tooltip" class="btn btn-success" href="'.route('customer_purchases_import',$attr['id']).'" data-original-title="" title="">
                                Import</a>':'<span data-id="'. $attr["id"] .'">Imported</span>';
        })->rawColumns(['actions'])->make(true);;
    }

    public function getAllOrders()
    {

        return Datatables::of(Orders::query())
            ->addColumn('actions', function ($attr) {
                return '<a rel="tooltip" class="btn btn-success" href="'.route('customer_orders_order',$attr->id).'" data-original-title="" title="">
                                View</a>';
            })
            ->editColumn('shop_id', function ($attr) {
                return $attr->shop->name;
            })->editColumn('status', function ($attr) {
                return $attr->status();
            })->editColumn('amount', function ($attr) {
                return $attr->items()->sum('price');
            })
            ->rawColumns(['actions'])->make(true);
    }

    public function getAllStaff($id=null)
    {
        $query = ($id) ? Staff::where('shop_id', $id) : Staff::whereIn('shop_id', \Auth::user()->shops()->pluck('id'));
        return Datatables::of($query)
            ->editColumn('status', function ($attr) {
                return Staff::$statuses[$attr->status];
            })->editColumn('shop_id', function ($attr) {
                return $attr->shop->name;
            })->editColumn('role_id', function ($attr) {
                return $attr->role->name;
            })
            ->addColumn('actions', function ($attr) {
                return
                    '
                    <a rel="tooltip" class="btn btn-success" href="'.route('staff_manage',$attr->id).'" data-original-title="" title="">Edit</a>
                    <a rel="tooltip" class="btn btn-info" href="'.route('staff_view',$attr->id).'" data-original-title="" title="">View</a>
'
                    ;
            })->rawColumns(['actions'])->make(true);
    }
    public function getAllStaffRoles()
    {

        return Datatables::of(StaffRoles::where('customer_id',\Auth::id()))
            ->addColumn('actions', function ($attr) {
                return '<a rel="tooltip" class="btn btn-success" href="'.route('staff_roles_create',$attr->id).'" data-original-title="" title="">
                                Edit</a>';
            })->rawColumns(['actions'])->make(true);
    }

}
