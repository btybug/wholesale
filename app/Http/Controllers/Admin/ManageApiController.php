<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 12/11/2018
 * Time: 10:34 AM
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Roles;
use App\Models\Settings;
use App\Services\ManagerApiRequest;
use App\Services\ManagerApiService;
use App\User;
use Illuminate\Http\Request;
use Matrix\Exception;

class ManageApiController extends Controller
{
    protected $view = 'admin.manage_api';

    public function index(Settings $settings)
    {
        $model = $settings->getEditableData('manage_api_export_users');
        return $this->view('index', compact('model'));
    }

    public function postSettings(Request $request, Settings $settings)
    {
        try{
            $data = $request->only(['client_id', 'client_secret']);
            $settings->updateOrCreateSettings('manage_api_settings', $data);
            $service = new ManagerApiService;
            $service->getAccessToken()->save();
        }catch (\Exception $exception){
            return redirect()->back()->with(['alert'=>['message'=>$exception->getMessage(),'class'=>'danger']]);
        }

        return redirect()
            ->back()
            ->with(['alert'=>['message'=>'New Connection made successfully!!!','class'=>'success']]);
    }

    public function getProducts()
    {
        return $this->view('products');
    }

    public function getItems()
    {
        return $this->view('items');
    }

    public function postManage(Request $request, Settings $settings)
    {
        $data = $request->except('_token');
        $data['customer_number']=1;
        $data['id']=1;
        $data['created_at']=1;
        $settings->updateOrCreateSettings('manage_api_export_users', $data);
        return redirect()->back();
    }

    public function getAllProducts(Request $request, ManagerApiRequest $apiRequest)
    {
        return $apiRequest->getProducts($request);
    }

    public function getAllItems(Request $request, ManagerApiRequest $apiRequest)
    {
        return $apiRequest->getItems($request);
    }

    public function exportCustomers(ManagerApiRequest $apiRequest)
    {
        return $apiRequest->exportCustomers();
    }
}