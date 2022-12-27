<?php

namespace App\Controllers\Login;

use App\Controllers\BaseController;

class AuthController extends BaseController
{
    public function userAuthenticator()
    {
        return view('client/auth/login');
    }

}