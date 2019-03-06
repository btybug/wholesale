<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 11/8/2018
 * Time: 1:59 PM
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

class EventsController extends Controller
{
    protected $view = 'admin.settings.events';

    public function getIndex()
    {
        return $this->view('index');
    }
}