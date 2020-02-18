<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

class PassportController extends Controller
{
    protected $view = 'admin.passport';

    public function index()
    {
        return $this->view('index');
    }
}
