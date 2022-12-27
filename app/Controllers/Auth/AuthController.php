<?php

namespace App\Controllers\Login;

use App\Controllers\BaseController;

class AuthController extends BaseController
{
    public function userAuthenticator()
    {
        $data['title'] = "HOME DESDE CONTROLLER";

        return view('client/templates/header')
            .view('client/auth/login')
            .view('client/templates/footer');
    }

}