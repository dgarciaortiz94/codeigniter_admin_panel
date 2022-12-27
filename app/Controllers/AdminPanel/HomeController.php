<?php

namespace App\Controllers\AdminPanel;

use App\Controllers\BaseController;

class HomeController extends BaseController
{
    public function index()
    {
        return view('client/home/index');
    }

}
