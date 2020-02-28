<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Requests\LandingRequest;
use App\Http\Controllers\Controller;
use App\Models\Landing;
use App\Models\Settings;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    protected $view = 'admin.landings';

    private $settings;

    public function __construct(Settings $settings)
    {
        $this->settings = $settings;
    }

    public function index()
    {
        return $this->view('index');
    }

    public function create()
    {
        $model = null;
        return $this->view('new', compact('model'));
    }

    public function postCreate(LandingRequest $request)
    {
        $data = $request->except('_token');
        Landing::create($data);

        return redirect()->route('admin_landings');
    }


    public function getDelete(Request $request)
    {
        $item = Landing::findOrFail($request->slug);
        $item->delete();
        return response()->json(['error' => false]);
    }

    public function edit($id)
    {
        $model = Landing::findOrFail($id);

        return $this->view('new', compact('model'));
    }

    public function postEdit(LandingRequest $request,$id)
    {
        $model = Landing::findOrFail($id);
        $model->update($request->except('_token'));

        return redirect()->route('admin_landings');
    }
}
