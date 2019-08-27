<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 10/10/2018
 * Time: 4:24 PM
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Statuses;
use App\Models\Ticket;
use App\Models\TicketFiles;
use App\Services\FileService;
use App\User;
use function GuzzleHttp\Promise\all;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    protected $view = 'admin.tools.statuses';

    public function __construct()
    {

    }


    public function getStatuses()
    {
        return $this->view('index');
    }

    public function getStatusesManage($type)
    {
        $statuses=Statuses::where('type',$type)->get();
        return $this->view('manage',compact('statuses','type'));
    }

    public function postStatusesManage(Request $request)
    {
        $data=$request->except(['_token','translatable'],[]);
        $status = Statuses::updateOrCreate($request->id,$data,$request->get('translatable',[]));

        return redirect()->back();
    }

    public function getStatusesTypes()
    {
        return $this->view('statuses.types');
    }

    public function postGetManageStatusForm(Request $request)
    {
        $model=Statuses::findOrFail($request->get('id'));
        $path=$this->view.'._patrials.status_form';
        $html=\View::make($path)->with(['model'=>$model,'type' => $model->type])->render();
        return \Response::json(['error'=>false,'html'=>$html]);
    }

    public function  postStatusesDelete(Request $request)
    {
        $model=Statuses::findOrFail($request->get('id'));

        if(! $model->is_default) $model->delete();

        return back();
    }
}
