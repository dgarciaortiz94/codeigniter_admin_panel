<?php

namespace App\Controllers\Client\Home;

use App\Controllers\BaseController;
use App\Models\VideoModel;

class HomeController extends BaseController
{
    public function index()
    {
        $videoModel = new VideoModel();
        $videos = $videoModel->findAll();

        return view('client/home/index', ['videos' => $videos]);
    }

}
