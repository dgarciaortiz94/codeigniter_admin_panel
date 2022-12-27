<?php

namespace App\Controllers\Register;

use App\Controllers\BaseController;
use App\Entities\User;
use App\Models\UserModel;

class RegisterController extends BaseController
{
    public function index()
    {
        $data['title'] = "HOME DESDE CONTROLLER"; // Capitalize the first letter

        return view('client/templates/header', $data)
            .view('register/index')
            .view('client/templates/footer');
    }


    public function save()
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