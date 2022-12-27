<?php

namespace App\Controllers\Client\User;

use App\Controllers\BaseController;
use App\Entities\User;
use App\Models\UserModel;

class UserController extends BaseController
{
    public function new()
    {
        $user = new User();

        $user->fill($this->request->getPost());
        $user->password = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        $user->active = true;
        $user->role = '["ROLE_USER"]';

        $userModel = new UserModel();
        $userModel->save($user);

        return redirect()->route('client_home');
    }

}