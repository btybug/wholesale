<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    protected $view='frontend.forum';
    public function index()
    {
        return $this->view('index');
    }
}
