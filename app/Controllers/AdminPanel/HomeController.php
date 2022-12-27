<?php

namespace App\Controllers\AdminPanel;

use App\Controllers\BaseController;

class HomeController extends BaseController
{
    public function index()
    {
        $data['title'] = "HOME DESDE CONTROLLER";

        return view('client/templates/header', $data)
            .view('client/home/index')
            .view('client/templates/footer');
    }

}
