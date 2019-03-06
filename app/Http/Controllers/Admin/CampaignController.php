<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CampaignRequest;
use App\Models\Campaign;
use PragmaRX\Countries\Package\Countries;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    protected $view = 'admin.campaign';

    private $countries;

    public function __construct(
        Countries $countries
    )
    {
        $this->countries = $countries;
    }

    public function index()
    {
        return $this->view('index');
    }

    public function create()
    {
        $model = null;
        $countries = array_filter($this->countries->all()->pluck('name.common', 'iso_a3')->toArray(), 'strlen');

        return $this->view('create', compact(['model', 'countries']));
    }

    public function postCreate(CampaignRequest $request)
    {
        $data = $request->except('_token');
        $data['model'] = '\App\Models\Customers';
        Campaign::create($data);
        return redirect()->route('admin_campaign');
    }

    public function edit($id)
    {
        $model = Campaign::findOrFail($id);
        $countries = $this->countries->all()->pluck('name.common', 'iso_a3')->toArray();

        return $this->view('create', compact(['model', 'countries']));
    }

    public function postEdit($id, CampaignRequest $request)
    {
        $model = Campaign::findOrFail($id);
        $data = $request->except('_token');
        $model->update($data);

        return route('admin_campaign');
    }

    public function postDelete(Request $request)
    {
        $model = Campaign::findOrFail($request->slug);

        $model->delete();

        return \Response::json(['error' => false]);
    }
}