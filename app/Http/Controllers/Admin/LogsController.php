<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 11/8/2018
 * Time: 10:43 AM
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

class LogsController extends Controller
{
    protected $view = 'admin.tools.logs';

    public function getFrontend()
    {
        return $this->view('frontend');
    }
    public function getBackend()
    {
        return $this->view('backend');
    }
}